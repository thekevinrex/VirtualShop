<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class SellerService {

    public static function isStartUp () {
        if (!Auth::user()->seller) {
            return false;
        }

        return true;
    }
}

?>
