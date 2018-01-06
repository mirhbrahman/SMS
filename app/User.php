<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    //.......const value for default field
    const VERIFIED_USER = true;
    const UNVERIFIED_USER = false;
    const ACTIVE_USER = true;
    const INACTIVE_USER = false;
    const ADMIN_USER = true;
    const REGULAR_USER = false;

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

    public function role()
    {
        return $this->belongsTo('App\Models\Admin\UserRole', 'role_id');
    }

    public function isVerified()
    {
        return $this->verified == self::VERIFIED_USER;
    }

    public function isActive()
    {
        return $this->is_active == self::ACTIVE_USER;
    }

    public function isAdmin()
    {
        return $this->is_admin == self::ADMIN_USER;
    }
}
