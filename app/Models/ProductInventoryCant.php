<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventoryCant extends Model
{
    use HasFactory;

    protected $fillable = [
        'cant',
        'state',
        'product_inventory_id',
    ];

    public function inventory () {
        return $this->belongsTo('App\Models\ProductInventory', 'product_inventory_id');
    }
}
