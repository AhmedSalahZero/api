<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
			'email'=>'required|email|max:255|unique:users,email',
			'password'=>'required|min:5',
			'password_confirmation'=>'required'
        ];
    }
	public function messages()
	{
		return [
			'name.required'=>__('Please Enter Your Name'),
			'name.max'=>__('Max Characters For Name Is 255'),
			'email.required'=>__('Please Enter Your Email Address'),
			'email.email'=>__('Please Enter Valid Email'),
			'email.max'=>__('Max Characters For Email Is 255'),
			'email.unique'=>__('This Email Address Already Exist'),
			'password.required'=>__('Please Enter Your Password'),
			'password.min'=>__('Please Enter At lease 5 Characters For Password'),
			'password_confirmation.required'=>__('Please Confirm Your Password')
		];
	}
	public function failedValidation(Validator $validator){
		throw new HttpResponseException(response()->json([
			'status'=>false , 
			'message'=>__('Failed To Create New Account'),
			'data'=>$validator->errors()->first()
		]));
	}
}
