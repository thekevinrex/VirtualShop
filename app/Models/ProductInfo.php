<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'product_id',
    ];

    public function product () {
        return $this->belongsTo('App\Models\Product');
    }
}
