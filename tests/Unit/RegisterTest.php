<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Requests\StoreRegisterRequest;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;


class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_create_new_user()
    {
		$registerController = new RegisterController;
		Artisan::call('passport:install');
		$registerController->store(new StoreRegisterRequest([
			'name'=>'salah123',
			'email'=>$email ='salah@gmail.com',
			'password'=>'salah123456',
			'password_confirmation'=>'salah123456',
		]));
		
		$this->assertDatabaseHas('users',['email'=>$email]);
		
    }
}
