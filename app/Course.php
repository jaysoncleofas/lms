<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function sections()
    {
        return $this->hasMany('App\Section')->where('isActive', true);
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }
}
