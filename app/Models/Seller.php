<?php

namespace App\Models;

use App\Notifications\SendPasswordResetNotificationToSeller;
use App\Notifications\VerifyEmailForSellers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'seller';
    
    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function data() {
        return $this->hasOne('App\Models\SellerData');
    }

    public function isNotStartUp () {
        return !$this->data;
    }

    public function avatar () {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
    
    public function addres () {
        return $this->morphOne('App\Models\Addres', 'addresable');
    }

    public function setPasswordAttribute($value ){
        $this->attributes['password'] = bcrypt($value);
    }

    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmailForSellers);
    }

    public function sendPasswordResetNotification ($token) {
        $this->notify(new SendPasswordResetNotificationToSeller($token));
    }
}
