<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'preferences',
        'province_id',
        'municipality_id',
    ];

    public function addresable () {
        return $this->morphTo();
    }

    public function province () {
        return $this->belongsTo('App\Models\Province');
    }

    public function municipality () {
        return $this->belongsTo('App\Models\municipality');
    }
}
