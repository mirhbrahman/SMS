<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    //.......Static field for default field
    public static $VERIFIED_USER = true;
    public static $UNVERIFIED_USER = false;
    public static $ACTIVE_USER = true;
    public static $INACTIVE_USER = false;
    public static $ADMIN_USER = true;
    public static $REGULAR_USER = false;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','name', 'email', 'password','verified','verification_token','role_id','is_active','is_admin','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generateUserId()
    {
        return (string)rand(1111, 9999) . time();
    }

    public static function generateVerificationToken()
    {
        return str_random(60);
    }
}
