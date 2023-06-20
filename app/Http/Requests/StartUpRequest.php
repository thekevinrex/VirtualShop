<?php

namespace App\Http\Requests;

use App\Services\SellerService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StartUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail() && !SellerService::isStartUp()){
            return true;
        }

        return false;
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

            'telephone' => 'required|int|digits:8|unique:sellers,telephone',
            'telegram' => 'nullable|unique:sellers,telegram',

            'address_name' => 'required|string',
            'address_location' => 'required|string',
            'address_preferencia' => '',

            'provincia' => 'required|int',
            'municipio' => 'required|int',

            'payment_option' => 'required|string',

            'plan' => 'required|string',
        ];
    }
}
