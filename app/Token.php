<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;

class Token extends Model
{
    protected $fillable = [
        'instructor_id',
        'section_id',
        'token',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

}
