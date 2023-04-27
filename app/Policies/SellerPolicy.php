<?php

namespace App\Policies;

use App\Models\User;
use App\Services\SellerService;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    public function startUp (User $user) {

        if (!SellerService::isStartUp())
            return true;

        return false;
    }
    
}
