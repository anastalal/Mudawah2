<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable=['name','description','owner_id','address',
    'map_locatation','image','bg_image','parent_id','seen','location_id','type'];
    public const TYPE_FACILITY = 'hospital';
    public const TYPE_FACILITY1 = 'clinic';
    

    public function phones(){
        return $this->hasMany(Phone::class,'facibility_id');
    }
    public function owner(){
        return $this->belongsTo(User::class);
    }
    public function clinics(){
        return $this->hasMany(Facility::class,'parent_id');
    }
    public function doctors(){
        return $this->
        belongsToMany(User::class,'doctor_clinics','facility_id','user_id')
        ->where('role_id',5)
        ->withPivot(['price'])->as('pivot');
    }
    
    public function devices(){
        return $this->hasMany(Device::class,'parent_id');
    }
    public function location(){
            return $this->belongsTo(Directorate::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class,'facility_id');
    }

    public function workDays(){
        return $this->belongsToMany(Workday::class,'workday_period','clinic_id','workday_id');
    }


    public function scopeClinicPeriods($query,$value){
        return $query->wherePivot('clinic_id',2);
    }
    //for medium relationshipe table
    

  
}
