<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public const TYPE_LIKE = 'like';
    public const TYPE_DISLIKE = 'dislike';

    protected $fillable = [
        'post_id',
        'likeable_type',
        'user_id'
    ];
}
