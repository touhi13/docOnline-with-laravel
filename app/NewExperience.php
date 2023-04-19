<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewExperience extends Model
{
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
