<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [
      'id'
    ];

    protected $dates = ['expireDate', 'startDate'];

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);;
    }

    public function questions()
    {
        return $this->hasMany('App\Question')->inRandomOrder();
    }

    public function checktakes($section_id)
    {
        return $this->hasMany('App\Take')->where('user_id', auth()->user()->id)->where('section_id', $section_id)->first();
    }

    public function takes($section_id, $student_id)
    {
        return $this->hasMany('App\Take')->where('user_id', $student_id)->orderBy('created_at', 'desc')->where('section_id', $section_id)->first();
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function takeQuiz()
    {
        return $this->hasOne('App\Take');
    }
}
