<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\User;

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
}
