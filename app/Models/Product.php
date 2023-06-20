<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        
        'name',
        'description',
        'listening_id',

        'seller_id',
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

    protected $appends = ['image', 'state'];

    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function listening()
    {
        return $this->belongsTo('App\Models\Listening');
    }

    public function cates () {
        return $this->hasMany('App\Models\ProductCate');
    }

    public function infos () {
        return $this->hasMany('App\Models\ProductInfo');
    }

    public function inventories () {
        return $this->hasMany('App\Models\ProductInventory');
    }

    public function variant () {
        return $this->hasOne('App\Models\ProductVariant');
    }
    
    public function modules () {
        return $this->hasMany('App\Models\ProductModule');
    }

    protected function Image(): Attribute
    {
        $image = '';

        if (count ($this->cates) > 0 ){
            $cate = $this->cates->where(function ($value) {
                return $value['with_images'];
            });

            $image = $cate[0]->variants[0]->image;
        } else {
            $image = $this->variant->image;
        }

        return new Attribute(
            get: fn () => $image,
        );
    }

    protected function State (): Attribute
    {
        $state = trans('product.verificando');

        if ($this->status == 1) {
            $state = trans('product.verificado');
        }

        if ($this->status == 2) {
            $state = trans('product.need_update');
        }

        if ($this->active == 0) {
            $state = trans('product.unaviable');
        }

        if ($this->trashed()) {
            $state = trans('product.deleted');
        }

        return new Attribute(
            get: fn() => $state,
        );
    }
    
    protected function Slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value),
            set: function ($value) {
                $slug = Str::slug($value, '-');

                $count = Product::where('name', $value)->count();

                if ($count > 0) {
                    $slug = $slug . '-' . $count;
                }

                return $slug;   
            },
        );
    }

    public function getRouteKeyName() {
        return 'slug';
    }
}
