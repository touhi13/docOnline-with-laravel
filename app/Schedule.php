<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'consultation_schedule';
    protected $fillable = ['doctor_id', 'time_slots'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}