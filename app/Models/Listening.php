<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listening extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'modelo_id',
        'category_id',
        'first_name',
    ];

    public function product () {
        return $this->hasMany('App\Models\Product');
    }

    public function modelo () {
        return $this->belongsTo('App\Models\Modelo');
    }

    public function marca () {
        return $this->belongsTo('App\Models\Marca');
    }

    public function category () {
        return $this->belongsTo('App\Models\Category');
    }
}
