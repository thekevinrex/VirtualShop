<?php

namespace App\Policies;

use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    public function startUp (Seller $seller) {
        if ($seller->data === null)
            return true;

        return false;
    }
    
}
