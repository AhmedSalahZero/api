<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function store(StoreRegisterRequest $request){
		
		$user = User::create([
			'name'=>$request->get('name'),
			'email'=>$request->get('email'),
			'password'=>Hash::make($request->get('password'))
		]);
		$token = $user->createToken($user->id)->accessToken ;
		
		return response()->json([
			'status'=>true,
			'message'=>__('New Account Has Been Created Successfully'),
			'data'=>[
				'user'=>new UserResource($user) , 
				'token'=>$token
			]
		]);
		
		
		
		
	}
}
