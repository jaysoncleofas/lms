<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'instructor_id',
        'section_id',
        'token',
        'status'
    ];

}
