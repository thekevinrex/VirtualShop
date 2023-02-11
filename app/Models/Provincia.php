<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function municipios () {
        return $this->hasMany(\App\Models\Municipio::class);
    }
}
