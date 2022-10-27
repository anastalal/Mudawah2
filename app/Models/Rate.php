<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    public $fillable =['stars_number','comment','user_id','doctor_id','facility_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function clinic(){
        return $this->belongsTo(Facility::class,'facility_id');
    }
}
