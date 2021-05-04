<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'role', 'profile_picture', 'address', 'province', 'subdistrict', 'city', 'zip', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public $silver  = 350;
    public $gold        = 350;
    public $platinum    = 700;
    public $diamond     = 7000;

    public function testimonials()
    {
        return $this->hasMany('App\Testimonial');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function sales()
    {
        return $this->belongsToMany('App\Sale');
    }
}
