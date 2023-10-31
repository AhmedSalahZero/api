<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Category;
use App\Models\Product;
use App\Models\User ; 
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	
	
	
	
    public function test_it_will_not_store_user_if_not_auth()
    {
		
		$productItem = [
			'name'=>'third product',
			'price'=>300,
			'category_id'=>Category::factory()->create()->id 
		];
		
		$this->json('post','/api/products',$productItem)->assertStatus(401);
		
		$user = User::factory()->create();

		$this->actingAs($user , 'api')->json('post','/api/products',$productItem)->assertJsonFragment(['status'=>true])->assertStatus(200);
    }
	
	public function test_it_updates_products()
	{
	
		$product = Product::factory()->create();
		
		$user = $product->user ; 
		
		$this->jsonAs($user,'put','/api/products/'.$product->id,['name'=>'second name']  )->assertStatus(200)->assertJsonFragment([
			'status'=>true
		]);
		
		
	}
	
	public function test_it_delete_product()
	{
		$product = Product::factory()->create();
		
		$user = $product->user ; 
		
		$this->jsonAs($user,'delete','/api/products/'.$product->id )->assertStatus(200)->assertJsonFragment([
			'status'=>true
		]);
	}
	
	
	public function test_it_will_no_user_if_not_auth()
	{
		User::factory()->count(4)->create();
		$product = Product::factory()->create();
		$user = User::where('id','!=',$product->user->id)->first();
		
		$this->jsonAs($user,'delete','/api/products/'.$product->id )->assertStatus(403)->assertJsonFragment([
			'status'=>false
		]);
	}
	
	public function test_it_will_not_must_be_auth_to_view_products()
    {

		$product = Product::factory()->create();
		$user = $product->user ; 
		$this->json('get','/api/products')->assertStatus(401);
		// $this->actingAs($user , 'api')->json('post','/api/products',$productItem)->assertJsonFragment(['status'=>true])->assertStatus(200);
    }
	
	public function test_it_can_view_if_products_if_is_auth()
    {

		$product = Product::factory()->create();
		$user = $product->user ; 
		$this->jsonAs($user,'get','/api/products')->assertStatus(200);
		
    }
	
	
	
}
