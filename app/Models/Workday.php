<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    use HasFactory;
    protected $fillable=['name','code'];

    public function periods(){
        return $this->belongsToMany(Period::class,'workday_period','workday_id','period_id')->withPivot('clinic_id','doctor_id');
    }


    public function doctor_clinic(){
        return $this->belongsToMany(DoctorClinic::class,'workday_period','doctor_id','period_id');
    }
    
}
