<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listening extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_model_id',
        'category_id',
        'name',
        'name_secondary',
    ];

    public function product () {
        return $this->hasMany('App\Models\Product');
    }

    public function model () {
        return $this->belongsTo('App\Models\BrandModel');
    }

    public function category () {
        return $this->belongsTo('App\Models\Category');
    }
}
