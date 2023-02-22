<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marca_id',
        'detail',
    ];

    public function marca () {
        return $this->belongsTo('App\Models\Marca');
    }
}
