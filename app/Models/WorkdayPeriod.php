<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkdayPeriod extends Pivot
{
    use HasFactory;
    protected $fillable=['workday_id','period_id','doctor_id','clinic_id'];
    public $timestamps = false;

    
}
