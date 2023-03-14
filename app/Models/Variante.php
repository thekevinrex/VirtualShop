<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'variante_cate_id',
    ];

    public function cate () {
        return $this->belongsTo('App\Models\VarianteCate');
    }

    public function product () {
        return $this->belongsTo('App\Models\Product');
    }

    public function image () {
        return $this->morphOne('App\Models\Image', 'imageable')->where('is_primary', true);
    }
    
    public function images () {
        return $this->morphMany('App\Models\Image', 'imageable');
    }


}
