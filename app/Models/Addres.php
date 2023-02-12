<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addres extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'name',
        'location',
        'aditional',
        'provincia_id',
        'municipio_id',
    ];

    public function addresable () {
        return $this->morphTo();
    }

    public function provincia () {
        return $this->belongsTo('App\Models\Provincia');
    }

    public function municipio () {
        return $this->belongsTo('App\Models\Municipio');
    }
}
