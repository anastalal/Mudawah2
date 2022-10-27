<?php

namespace App\Models;

use App\Models\post as ModelsPost;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Role;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'imgages',
        'description',
        'followers',
        'images',
        'parent_id',
        'seen',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function comment()
    {
     return   $this->hasMany(comment::class);
    }

    public function post(){
       return $this->hasMany(post::class);
    }

    public function phone()
    {
        return $this->hasMany(Phone::class);

    }
    
    public function rates()
    {
        return $this->hasMany(Rate::class,'doctor_id');
    }

    public function clinics()
    {
        return $this->belongsToMany(Facility::class,'doctor_clinics','user_id','facility_id')->withPivot(['price'])->as('check_price');

    }
    public function specializitions()
    {
      //  return $this->belongsToMany(Specializition::class,'doctor_specializitions','specializitions_id','users_id');
        return $this->belongsToMany(Specializition::class,'doctor_specializitions','doctor_id','specializition_id');

    }
    public function workday()
    {      //  return $this->belongsToMany(Specializition::class,'doctor_specializitions','specializitions_id','users_id');
        return $this->belongsToMany(Workday::class,'workday_period','doctor_id','workday_id');
    }
    public function periods()
    {      //  return $this->belongsToMany(Specializition::class,'doctor_specializitions','specializitions_id','users_id');
        return $this->belongsToMany(Period::class,'workday_period','doctor_id','period_id');
    }
    public function doctors()
    {      //  return $this->belongsToMany(Specializition::class,'doctor_specializitions','specializitions_id','users_id');
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }
    public function role()
    {      //  return $this->belongsToMany(Specializition::class,'doctor_specializitions','specializitions_id','users_id');
        return $this->belongsTo(Role::class);
    }
    

    
}
