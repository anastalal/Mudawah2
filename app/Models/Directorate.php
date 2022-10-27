<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable=['name','code','city_id'];

    public function country(){
        return $this->hasMany(Country::class);
    }
    
    public function City(){
        return $this->belongsTo(City::class);
    }

}
