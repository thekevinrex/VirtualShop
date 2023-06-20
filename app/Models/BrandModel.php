<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'detail',
    ];

    public function brand () {
        return $this->belongsTo('App\Models\Brand');
    }
}
