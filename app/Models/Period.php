<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $fillable=['name','from_time','to_time'];
    public function periods(){
        return $this->belongsToMany(Workday::class,'workday_period','period_id','workday_id');
    }   
    
}
