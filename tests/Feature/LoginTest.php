<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_login_user()
    {
		Artisan::call('passport:install');
		$user = User::factory()->create([
			'password'=>Hash::make('admin123456')
		]);
		
		$this->json('post','/api/login',[
			'email'=>$user->email,
			'password'=>'admin123456',
		])->assertJsonFragment(['status'=>true ])->assertJsonStructure(['data']);
		
    }
}
