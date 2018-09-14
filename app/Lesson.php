<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
      'instructor_id',
      'course_id',
      'title',
      'description',
      'status'
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }
}
