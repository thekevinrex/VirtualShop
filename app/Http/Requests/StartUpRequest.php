<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartUpRequest extends FormRequest
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
            'name' => 'required|string',
            'abaut_me' => '',
            'avatar.image' => 'required|string',

            'phone' => 'required|int|digits:8|unique:sellers,telephone',
            'telegram' => 'nullable|unique:sellers,telegram',

            'address_name' => 'required|string',
            'address_location' => 'required|string',
            'address_preferencia' => '',

            'provincia' => 'required|int',
            'municipio' => 'required|int',

            'qvapay' => 'required|string',

            'plan' => 'required|string',
        ];
    }
}
