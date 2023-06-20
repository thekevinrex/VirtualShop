<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_cate_id',
        'product_id',
    ];

    public function cate () {
        return $this->belongsTo('App\Models\ProductCate', 'product_cate_id');
    }

    public function product () {
        return $this->belongsTo('App\Models\Product');
    }

    public function image () {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
    
    public function images () {
        return $this->morphMany('App\Models\Image', 'imageable');
    }


}
