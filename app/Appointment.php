<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'total_amount',
        'status',
        'tran_id', // Add this line
        'currency',
        'time_slot',
        'day'
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function reviews()
    {
        return $this->hasOne(Review::class);
    }
}
