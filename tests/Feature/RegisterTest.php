<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_register_new_user()
    {
		Artisan::call('passport:install');
		
		$this->json('post','/api/register',[
			'name'=>'salah123',
			'email'=>$email ='salah@gmail.com',
			'password'=>'salah123456',
			'password_confirmation'=>'salah123456',
		])->assertJsonFragment(['status'=>true ]);
    }
}
