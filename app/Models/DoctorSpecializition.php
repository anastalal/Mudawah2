<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecializition extends Model
{
    use HasFactory;

    protected $fillable=['doctor_id','specializition_id'];

    public function doctors(){
        return $this->belongsTo(User::class);
    }

    public function specializations(){
        return $this->belongsTo(Specializition::class);
    }
}
