<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'instructor_id',
        'course_id',
        'section_id',
        'message'
    ];

    public function instructor()
    {
        return $this->belongsTo('App\User');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);;
    }
}
