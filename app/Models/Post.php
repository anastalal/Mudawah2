<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Post extends Model
{
   use HasFactory;
   protected $fillable = [
      'title',
      'content',
      'date_written',
      'featured_image',
      'votes_up',
      'votes_down',
      'user_id',
      'category_id',
      'seen',
      'image'
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function comment()
   {
      return $this->hasMany(Comment::class);
   }

   

   public function likes()
   {
      return $this->hasMany(Like::class);
   }
   public function scopeLikes($query)
   {
      return $query->where('id', 412)->get();
   }

   public function categories()
   {
       return $this->belongsToMany(Category::class,'post_categories','post_id','category_id');

   }
   // public function category()
   // {
   //    return $this->belongsTo(post_category::class, 'category_id', 'post_id');
   // }

   // protected $attributes = [

   //    'date_written' => date('Y-m-d')
   // ];
}
