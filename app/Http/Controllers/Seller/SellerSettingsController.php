<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;

class SellerSettingsController extends Controller
{
    
    public function index ($view = null) {

        if ( $view != null && !in_array($view, ['info', 'payment', 'address'])){
            abort(404);
        }

        $settings = Auth::user()->seller()->with('address')->first();

        $provincies = [];
        $municipalities = [];

        if (in_array($view, ['address'])){
            $provincies = Province::all();
            $municipalities = Municipality::where('province_id', $settings->address->province_id)->get();
        }

        return view('seller.settings.content', ['view' => $view])
            ->with(compact('settings', 'provincies', 'municipalities'));
    }

    public function info () {

        $settings = Auth::user()->seller;

        return view('seller.settings.content', ['view' => 'info'])
            ->with(compact('settings'));
    }

    public function updateInfo (Request $request) {

        $seller = $request->user()->seller;

        $validated = $request->validate([
            'name' => 'required|string',
            'abaut_me' => '',
            'avatar.image' => 'required|string',

            'telephone' => [
                'required',
                'int',
                'digits:8',
                Rule::unique('sellers', 'telephone')->ignore($seller),
            ],
            'telegram' => [
                'nullable',
                Rule::unique('sellers', 'telegram')->ignore($seller),
            ],
        ]);

        $seller->update($validated);

        if ($seller->avatar->url != $validated['avatar']['image']) {
            $seller->avatar()->delete();
            $seller->avatar()->create(['url' => $validated['avatar']['image']]);
        }

        Toast::message(trans('The seller profile was updated correctly'))
            ->backdrop()
            ->success()
            ->rightBottom()
            ->autoDismiss(5);

        return redirect()->back();
    }

    public function updatePayment (Request $request) {

        $seller = $request->user()->seller;

        $validated = $request->validate([
            'payment_option' => 'required|string',
        ]);

        $seller->update($validated);

        Toast::message(trans('The seller payment settings was updated correctly'))
            ->backdrop()
            ->success()
            ->rightBottom()
            ->autoDismiss(5);

        return redirect()->back();
    }

    public function updateAddress (Request $request) {

        $seller = $request->user()->seller;

        $safe = $request->validate([
            'address_name' => 'required|string',
            'address_location' => 'required|string',
            'address_preferencia' => '',

            'provincia' => 'required|int',
            'municipio' => 'required|int',
        ]);

        $addressData = [
            'province_id' => $safe['provincia'],
            'municipality_id' => $safe['municipio'],
            'name' => $safe['address_name'],
            'location' => $safe['address_location'],
            'preferences' => $safe['address_preferencia'],
        ];

        $seller->address()->update($addressData);

        Toast::message(trans('The seller address settings was updated correctly'))
            ->backdrop()
            ->success()
            ->rightBottom()
            ->autoDismiss(5);

        return redirect()->back();
    }
}
