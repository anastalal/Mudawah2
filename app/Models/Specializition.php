<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specializition extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];

    public function doctors(){
        return $this->belongsToMany(User::class,
        'doctor_specializitions','specializition_id','doctor_id')
        ->where('role_id',5);
    }
    
}
