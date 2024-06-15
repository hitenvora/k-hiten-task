<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        return
        [
			'product_name' => 'required',
			// 'description' => 'required',
			// 'meta_title' => 'required',
			// 'meta_description' => 'required',
			'category' => 'required',
			'sub_category' => 'required',
			'per_gram_price' => 'required',
			'image' => 'required',
			'barcodenumber' => 'required',
			'barcode_img' => 'required',
			'gst' => 'required',
			'discount' => 'required',
			'firm_id' => 'required',
			'volume' => 'required',
            
			'hsn_cod' => 'required',
			'mrp' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }
}
