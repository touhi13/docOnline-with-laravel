<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationFee extends Model
{
    protected $table = 'consultation_schedule';
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}