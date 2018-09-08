<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Question;

class Quiz extends Model
{
    protected $fillable = [
      'instructor_id',
      'course_id',
      'title',
      'isActive'
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
