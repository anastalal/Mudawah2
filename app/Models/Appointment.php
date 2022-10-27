<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'clinic_id',
        'workday_period_id',
        'price',
        'state_id',
        'time',
        'patient_name',
        'patient_age',
        'patient_phone',
        'is_first_time',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function clinic()
    {
        return $this->belongsTo(Facility::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function workday()
    {
        return $this->belongsTo(Workday::class);
    }
    public function state()
    {
        return $this->belongsTo(AppointmentState::class,'state_id');
    }

    
}
