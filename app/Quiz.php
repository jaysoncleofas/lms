<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [
      'id'
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section');
    }

    public function questions()
    {
        return $this->hasMany('App\Question')->inRandomOrder();
    }

    public function checktakes()
    {
        return $this->hasMany('App\Take')->where('user_id', auth()->user()->id)->first();
    }

    public function takes()
    {
        return $this->hasMany('App\Take')->orderBy('created_at', 'desc')->first();
    }
}
