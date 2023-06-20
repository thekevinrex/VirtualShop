<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $with = ['avatar'];
    
    protected $fillable = [
        'name',
        'abaut_me',
        'plan',
        'telephone',
        'telegram',
        'payment_method',
        'payment_option',
    ];

    protected $hidden = [
        'plan_transaction_id',
        'payment_options',
        'payment_method',
    ];

    protected $casts = [
        'plan_verified_at' => 'datetime',
    ];

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

    public function avatar () {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
    
    public function address () {
        return $this->morphOne('App\Models\Address', 'addresable');
    }

    public function products () {
        return $this->hasMany('App\Models\Product');
    }

    public function setPasswordAttribute($value ){
        $this->attributes['password'] = bcrypt($value);
    }

}
