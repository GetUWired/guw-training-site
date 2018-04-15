<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Set extends Model
{
    use Searchable;
    
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
