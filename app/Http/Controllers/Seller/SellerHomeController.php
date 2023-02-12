<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StartUpRequest;
use App\Models\Provincia;
use Illuminate\Http\Request;

class SellerHomeController extends Controller
{

    public function index () {
        return view('seller.docs');
    }

    public function pricing() {
        return view('seller.pricing');
    }

    public function start ($plan) {

        if (!in_array($plan, array('individual', 'profesional'))){
            return redirect()->route('seller.pricing');
        }

        $provincias = Provincia::all();

        return view('seller.start-up')
            ->with(compact(['plan', 'provincias']));
    }

    public function startUp (StartUpRequest $request) {

        $safe = $request->validated();

        $avatar = [
            'url' => $safe['avatar'],
        ];
    
        $sellerData = $request->safe()->only('name', 'abaut_me', 'telegram', 'plan');
        $sellerData['telephone'] = $safe['phone'];

        $sellerData['payment_method'] = 'qvapay';
        $sellerData['payment_option'] = $safe['qvapay'];

        $addressData = [
            'provincia_id' => $safe['provincia'],
            'municipio_id' => $safe['municipio'],
            'name' => $safe['address_name'],
            'location' => $safe['address_location'],
            'aditional' => $safe['address_preferencia'],
        ];
        
        $request->user()->data()->create($sellerData);
        $request->user()->addres()->create($addressData);
        $request->user()->avatar()->create($avatar);

        return redirect()->route('seller.dashboard');
    }
}
