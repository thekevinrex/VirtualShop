<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => '',
            'restric_age' => 'boolean',
            'ratings' => '',
            'category' => 'int|exists:categories,id',
            'modelo' => 'int|exclude_if:modelo,0|exists:modelos,id',

            'details.*.key' => 'string|required|max:100',
            'details.*.value' => 'string|required|max:255',
            'details.*.id' => '',

            'cates.*.value' => 'string|required|max:255',
            'cates.*.with_image' => 'boolean',
            'cates.*.id' => '',

            'variantes.*.cate' => '',
            'variantes.*.des' => '',
            'variantes.*.name' => 'string|required|max:255',
            'variantes.*.image.image' => '',
            'variantes.*.images' => '',
            'variantes.*.id' => '',

            'price' => 'required|numeric',
            'currency' => '',
            'mergedVariantes' => '',
            'delivery' => '',
            'delivery_data' => '',
        ];
    }
}
