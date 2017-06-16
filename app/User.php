<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function favouriteContacts(){
        return $this->belongsToMany(User::class,'favourite_contacts', 'user_id', 'contact_id');
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }


}
