<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
            'name'=>'required|max:255|unique:products,name',
			'price'=>'required|numeric',
			'category_id'=>'required|exists:categories,id'
        ];
    }
	public function messages()
	{
		return [
			'name.required'=>__('Please Enter Product Name'),
			'name.max'=>__('Max Character Allowed For Product Name Is 255'),
			'name.unique'=>__('This Product Already Exists'),
			'category_id.required'=>__('Please Enter Category Id'),
			'category_id.exists'=>__('This Category Id Does Not Exist In Our Records'),
		];
	}
	public function failedValidation(Validator $validator){
		throw new HttpResponseException(response()->json([
			'status'=>false , 
			'message'=>__('Invalid Product Data'),
			'data'=>$validator->errors()->first()
		]));
	}
}
