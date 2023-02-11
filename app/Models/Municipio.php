<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function provincia () {
        return $this->belongsTo(\App\Models\Provincia::class);
    }
}
