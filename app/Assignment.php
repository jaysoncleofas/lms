<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;

class Assignment extends Model
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
}
