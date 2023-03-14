<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'seller_id',
        'listening_id',
        'by_seller_id',
        
        'price',
        'currency',
        'restricted_age',
        'formato',
        'ratings',

        'shipping',
        'shipping_aviable',

        'status',
        'active',
        'slug',
    ];

    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function listening()
    {
        return $this->belongsTo('App\Models\Listening');
    }

    public function cates () {
        return $this->hasMany('App\Models\VarianteCate');
    }

    public function infos () {
        return $this->hasMany('App\Models\ProductInfo');
    }

    public function inventories () {
        return $this->hasMany('App\Models\ProductInventory');
    }

    public function variante () {
        return $this->hasOne('App\Models\Variante');
    }

    public function setSlugAttribute ($value) {
        $slug = Str::slug($value, '-');

        $count = Product::where('name', $value)->count();

        if ($count > 0) {
            $slug = $slug . '-' . $count;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName() {
        return 'slug';
    }
}
