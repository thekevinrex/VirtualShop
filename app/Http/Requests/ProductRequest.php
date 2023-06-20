<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if ($this->seller_id != Auth::user()->seller->id)
            return false;

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

            'seller_id' => 'required|int|exists:sellers,id',

            'name' => 'required|string|max:255',
            'description' => '',
            'restricted_age' => 'boolean',
            'ratings' => '',
            'category_id' => 'int|exists:categories,id',
            'brand_model_id' => 'int|exclude_if:brand_model_id,0|exists:brand_models,id',

            'details.*.key' => 'string|required|max:100',
            'details.*.value' => 'string|required|max:255',
            'details.*.id' => '',

            'cates.*.value' => 'string|required|max:255',
            'cates.*.with_images' => 'boolean',
            'cates.*.id' => '',

            'variants.*.cate' => '',
            'variants.*.des' => '',
            'variants.*.name' => 'string|required|max:255',
            'variants.*.image.image' => '',
            'variants.*.images' => '',
            'variants.*.id' => '',

            'price' => 'required|numeric',
            'currency' => '',
            'mergedVariants' => '',
            'shipping' => '',
            'shipping_aviable' => '',
            'payments' => '',
        ];
    }
}
