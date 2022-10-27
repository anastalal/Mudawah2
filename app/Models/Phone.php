<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable=['phone_number','description','user_id','facibility_id'];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }
    public function facility()
    {
       return $this->belongsTo(Facility::class,'facibility_id');
    }


}
