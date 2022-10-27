<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Role extends \TCG\Voyager\Models\Role
{
    protected $guarded = [];

    public function users()
    {
        $userModel = Voyager::modelClass('User');

        return $this->belongsToMany($userModel, 'user_roles')
                    ->select(app($userModel)->getTable().'.*')
                    ->union($this->hasMany($userModel))->getQuery();
    }

    public function permissions()
    {
        return $this->belongsToMany(Voyager::modelClass('Permission'));
    }
    public function u()
    {
        return $this->hasMany(User::class);
    }

    public function doctors()
    {
         return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }

   
}
