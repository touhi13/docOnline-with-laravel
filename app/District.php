<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
