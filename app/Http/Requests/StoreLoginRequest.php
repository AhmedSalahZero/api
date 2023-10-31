<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLoginRequest extends FormRequest
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
			'email'=>'required|email|max:255|exists:users,email',
			'password'=>'required|min:5',
        ];
    }
	public function messages()
	{
		return [
			'email.required'=>__('Please Enter Your Email Address'),
			'email.email'=>__('Please Enter Valid Email'),
			'email.max'=>__('Max Characters For Email Is 255'),
			'email.exists'=>__('This Email Address Does Not Exist In Our Records'),
			'password.required'=>__('Please Enter Your Password'),
			'password.min'=>__('Please Enter At lease 5 Characters For Password'),
		];
	}
	public function failedValidation(Validator $validator){
		throw new HttpResponseException(response()->json([
			'status'=>false , 
			'message'=>__('Invalid Login Data'),
			'data'=>$validator->errors()->first()
		]));
	}
}
