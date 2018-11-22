<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role ()
    {
        return $this->belongsTo(Role::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password))
        {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function isAdmin()
    {
        if ($this->role->id == 1 && $this->is_active == 1)
        {
            return true;
        }
        return false;
    }
}
