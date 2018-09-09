<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'instructor_id',
        'course_id',
        'name',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson');
    }

    public function quizzes()
    {
        return $this->belongsToMany('App\Quiz');
    }

    public function assignments()
    {
        return $this->belongsToMany('App\Assignment');
    }

    public function announcements()
    {
        return $this->belongsToMany('App\Announcement')->orderBy('created_at', 'desc');
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'section_user');
    }
}
