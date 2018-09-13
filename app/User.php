<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'firstName',
        'middleName',
        'lastName',
        'birthDate',
        'email',
        'username',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }


    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
