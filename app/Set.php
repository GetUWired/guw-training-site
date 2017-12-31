<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    public function getRouteKeyName()
    {
        return 'set_id';
    }

//    public function problem()
//    {
//        return $this->belongsTo('App\Problem');
//    }

    public function problems()
    {
        return $this->belongsToMany('App\Problem')->withTimestamps()->using('App\ProblemSet');
    }
}
