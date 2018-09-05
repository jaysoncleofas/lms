<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Section;

class Announcement extends Model
{
    protected $fillable = [
        'instructor_id',
        'course_id',
        'section_id',
        'content'
    ];

    public function instructor()
    {
        return $this->belongsTo('App\User');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }
}
