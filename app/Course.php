<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }
}
