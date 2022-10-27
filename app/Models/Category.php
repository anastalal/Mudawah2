<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable=[
        'title',
      ];

      public function posts()
   {
       return $this->belongsToMany(Post::class,'post_categories','category_id','post_id');

   }
}
