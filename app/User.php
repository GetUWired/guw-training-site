<?php

namespace App;

use App\Notifications\MailResetPasswordToken;
use Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function problems()
    {
        return $this->belongsToMany('App\Problem')->withTimestamps()->using('App\UserProblem');
    }
    
    public function isAdmin()
    {
        return $this->user_level == 10;
    }
    
    /**
     * Send a password reset email to the user
     * @param $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token)); //Todo change this for real PW resets.
    }
}
