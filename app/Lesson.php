<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;

class Lesson extends Model
{
    protected $fillable = [
      'instructor_id',
      'course_id',
      'title',
      'content',
      'status'
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }
}
