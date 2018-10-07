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
        'avatar',
        'mobileNumber',
        'studentNumber'
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
        return $this->belongsToMany('App\Section')->where('isActive', true);
    }


    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }

    public function convos()
    {
        return $this->hasMany('App\Convo');
    }

    public function messages()
    {
        return $this->hasMany('App\Mesage');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function takes()
    {
        return $this->hasMany('App\Take');
    }

    public function passes()
    {
        return $this->hasMany('App\Pass');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function quizzes()
    {
        return $this->hasMany('App\User');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function name()
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }
}


// $user->courses()->detach();
// $user->sections()->delete();
// $user->announcements()->delete();
// $user->lessons()->delete();
// $user->quizzes()->delete();
// $user->tokens()->delete();
// $user->files()->delete();
// $user->convos()->delete();
// $user->convos()->delete();
// $user->assignments()->delete();
// $user->takes()->delete();
// $user->passes()->delete();
