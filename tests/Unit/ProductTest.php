<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
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
		$this->assertTrue(true);
		
		$productController = new ProductController();
		Artisan::call('passport:install');
		$user = User::factory()->create();
		$productItem = [
			'name'=>'third product',
			'price'=>300,
			'category_id'=>Category::factory()->create()->id,
			'user_id'=>$user->id 
		];
		
		$productController->store(new StoreProductRequest($productItem));
		$this->assertDatabaseHas('products',['name'=>'third product']);
	}
	

}
