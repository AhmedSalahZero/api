<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	public function store(StoreLoginRequest $request){
		
		$isExist = auth()->attempt([
			'email'=>$request->get('email'),
			'password'=>$request->get('password')
		]);
		if($isExist){
			$user = User::where('email',$request->get('email'))->first();
			$token = $user->createToken($user->id)->accessToken ;
			return response()->json([
				'status'=>true,
				'message'=>__('Success Login Attempt'),
				'data'=>[
					'user'=>new UserResource($user) , 
					'token'=>$token
				]
			]);	
		}
		return response()->json([
			'status'=>false ,
			'message'=>__('Invalid Password')
		]);
		
	}
}
