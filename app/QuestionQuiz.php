<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionQuiz extends Model
{
    protected $fillable = [
        'quiz_id',
        'question',
        'image',
        'answer',
        'choiceOne',
        'choiceTwo',
        'choiceThree',
    ];

}
