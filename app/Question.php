<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quiz;

class Question extends Model
{
    protected $guarded = ['id'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
