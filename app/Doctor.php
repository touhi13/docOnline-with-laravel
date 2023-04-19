<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Doctor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'doctor';

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'name',
        'date_of_birth',
        'gender',
        'district_id',
        'nid',
        'regno',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function generateSlug()
    {
        $pattern = '/[^\p{L}\p{N}]+/u';
        $replacement = '-';
        $newString = preg_replace($pattern, $replacement, $this->name);
        $slug = Str::slug($newString) . '-' . $this->getKey();
        return $slug;
    }
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }
    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }
    public function additionalQualifications(): HasMany
    {
        return $this->hasMany(AdditionalQualification::class);
    }
    public function newExperiences(): HasMany
    {
        return $this->hasMany(NewExperience::class);
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
    public function consultationFee()
    {
        return $this->hasOne(ConsultationFee::class);
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
