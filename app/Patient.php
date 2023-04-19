<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Patient extends Model
{
    protected $table = 'users';
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
