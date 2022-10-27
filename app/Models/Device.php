<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillabe=[
        'name',
        'model',
        'description',
        'price',
        'parent_id',
        'image',
     ];

     public function facility(){
        return $this->belongsTo(Facility::class);
     }
}
