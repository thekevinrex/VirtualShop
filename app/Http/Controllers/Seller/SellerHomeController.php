<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
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

        return view('seller.start-up')
            ->with('plan', $plan );
    }
}
