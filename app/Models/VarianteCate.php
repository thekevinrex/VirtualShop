<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarianteCate extends Model
{
    use HasFactory;

    protected $fillable = [
        'with_image',
        'cate_name',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variantes () {
        return $this->hasMany('App\Models\Variante');
    }
}
