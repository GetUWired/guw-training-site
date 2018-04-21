<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
    protected $fillable = ['problem_id', 'hint'];
    
    public function problems()
    {
        return $this->belongsTo('App\Problem');
    }
}
