<?php

namespace App;

use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Hash;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Password mutator
    */
    public function setPasswordAttribute($value)
    {
       if($value && strlen($value) > 0) {
           $this->attributes['password'] = Hash::make($value);
       }
    }

    //RELATIONSHIPS

    /**
     * User has one UserDetail
     */
    public function userDetail()
    {
        return $this->hasOne('App\Common\Models\UserDetail');
    }
}
