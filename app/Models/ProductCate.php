<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCate extends Model
{
    use HasFactory;

    protected $fillable = [
        'with_images',
        'name',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variants () {
        return $this->hasMany('App\Models\ProductVariant');
    }
}
