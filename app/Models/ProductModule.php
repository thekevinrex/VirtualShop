<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'product_id',
        'order',
        'type',
    ];

    public function image () {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function product () {
        return $this->belongsTo('App\Models\Product');
    }
}
