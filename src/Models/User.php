<?php

namespace Farbesofts\Checkrole\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Farbesofts\Checkrole\Models\Role;
use Illuminate\Support\Facades\DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password',];

    protected $hidden = ['password', 'remember_token',];

    public function personal()
    {
        return $this->hasOne(Personal::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return  true;
        }
        return false;
    }

    public function Timetable(){
        return $this->hasOne(Timetable::class);
    }

    public function getTimetable(){
        return $this->Timetable()->where('user_id',Auth::user()->id)->first();
    }
}
