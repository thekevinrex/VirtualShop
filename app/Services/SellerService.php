<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerService {

    public static function isStartUp () {
        if (!Auth::user()->seller) {
            return false;
        }

        return true;
    }

    public function getAvatarUrl (User $user) {

        if (!$user->seller) {
            return false;
        }

        if (!$user->seller->avatar) {
            return false;
        }

        return Storage::url($user->seller->avatar->url);
    }
}

?>
