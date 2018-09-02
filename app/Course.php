<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Section;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }
}
