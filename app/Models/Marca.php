<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'des',
    ];

    public function modelos() {
        return $this->hasMany('App\Models\Modelo');
    }
}
