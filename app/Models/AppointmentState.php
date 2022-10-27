<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentState extends Model
{
    use HasFactory;

    protected $fillable=['name','code'];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
