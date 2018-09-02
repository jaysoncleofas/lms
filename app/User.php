<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Course;
use App\Announcement;
use App\Section;

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
}
