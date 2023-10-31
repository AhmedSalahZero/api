<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
	{
		
		$price = $request->get('price');
		$orderByField = $request->has('order_by') ? $request->get('order_by') : 'id';
		$direction = $request->has('direction') ? $request->get('direction') : 'desc';
		
		$products = Product::where('user_id',$request->user()->id)
		->orderBy($orderByField,$direction)
		->when($request->has('price') , function(Builder $builder) use($price) {
			$builder->where('price',$price );
		})->when($request->get('category_id'),function(Builder $builder) use ($request){
			$builder->whereIn('category_id',(array)$request->get('category_id'));
		})->get();
		
		return response()->json([
			'status'=>true , 
			'message'=>__('Success'),
			'data'=>ProductResource::collection($products)
		]);
		
	}
	public function store(StoreProductRequest $request){
		$product = Product::create([
			'name'=>$name=$request->get('name'),
			'slug'=>Str::slug($name),
			'price'=>$request->get('price'),
			'category_id'=>$request->get('category_id'),
			'user_id'=>$request->has('user_id') ? $request->get('user_id') :  $request->user()->id 
		]);
		
		return response()->json([
			'status'=>true ,
			'message'=>__('New Product Has Been Stored Successfully'),
			'data'=>new ProductResource($product)
		]);
	}
	
	public function update(Request $request,Product $product){
		
		 $canUpdate = $request->user()->can('update',$product);
		 
		if(!$canUpdate){
			return response()->json([
				'status'=>false,
				'message'=>__('Your Can Not Update This Product') 
			],403);
		}
		$product->update($request->only(['name','price','category_id','user_id']));
		
		return response()->json([
			'status'=>true , 
			'message'=>__('Product Updated Successfully'),
			'data'=>new ProductResource($product)
		]);
		
	}
	
	public function destroy(Request $request , Product $product){
		$canDeleteProduct = $request->user()->can('delete',$product);
		if(!$canDeleteProduct){
			return response()->json([
				'status'=>false ,
				'message'=>__('You Can Not Delete This Product')
			],403);
		}
		$product->delete();
		return response()->json([
			'status'=>true ,
			'message'=>__('Product Has Been Delete Successfully')
		]);
		
	}
}
