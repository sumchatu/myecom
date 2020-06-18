<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_size' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required',
            'product_details' => 'required',
            'image_one' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_two' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image_three' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
