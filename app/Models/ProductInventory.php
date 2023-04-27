<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'product_id',
        'merged',
        'price',
        'active',
    ];

    public function product () {
        return $this->belongsTo('App\Models\Product');
    }

    public function cantInventory () {
        return $this->hasMany('App\Models\ProductInventoryCant');
    }

    public function setSlugAttribute ($value) {
        $slug = Str::slug($value, '-');

        $count = ProductInventory::where('slug', $slug)->count();

        if ($count > 0) {
            while (ProductInventory::where('slug', $slug . "-" . $count)->count() > 0) {
                $count++;
            }

            $slug = $slug . '-' . $count;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
