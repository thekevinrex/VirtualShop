<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerData extends Model
{
    use HasFactory;

    // protected $table = 'sellers_data';

    protected $fillable = [
        'name',
        'abaut_me',
        'plan',
        'telephone',
        'telegram',
        'payment_method',
        'payment_option',
    ];

    protected $hidden = [
        'plan_transaction_id',
        'payment_options',
        'payment_method',
    ];

    protected $casts = [
        'plan_verified_at' => 'datetime',
    ];

    public function seller () {
        return $this->belongsTo('App\Models\Seller');
    }

}
