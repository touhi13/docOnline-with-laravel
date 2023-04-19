<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name','provider', 'provider_id', 'date_of_birth', 'gender', 'photo', 'status', 'phone', 'email', 'password', 'present_address', 'permanent_address'
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

    public function Award()
    {
        return $this->hasMany('App\Award');
    }
    public function Education()
    {
        return $this->hasMany('App\Education');
    }
    public function Membership()
    {
        return $this->hasMany('App\Membership');
    }
    public function Registration()
    {
        return $this->hasMany('App\Registration');
    }
    public function contact()
    {
        return $this->hasMany('App\Contact');
    }
    public function review()
    {
        return $this->hasMany('App\Review');
    }
}
