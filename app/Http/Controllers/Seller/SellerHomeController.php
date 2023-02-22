<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StartUpRequest;
use App\Models\Provincia;
use App\Models\Seller;

class SellerHomeController extends Controller
{

    /**
     * Show the documentation seller page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index () {
        return view('seller.docs');
    }

    /**
     * Show the pricing page of the seller panel application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pricing() {
        return view('seller.pricing');
    }

    /**
     * Show the start up form for the seller panel and verify if the user is authorize to doit
     * @param mixed $plan
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function start ($plan) {

        $this->authorize('startUp', Seller::class);

        if (!in_array($plan, array('individual', 'profesional'))){
            return redirect()->route('seller.pricing');
        }

        $provincias = Provincia::all();

        return view('seller.start-up')
            ->with(compact(['plan', 'provincias']));
    }

    /**
     * Handle a request to start up a seller
     * @param StartUpRequest $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function startUp (StartUpRequest $request) {

        $this->authorize('startUp', Seller::class);
        
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
