<?php

namespace App\Http\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'name'          =>'required|max:255',
        'email'         =>'required|email|unique:users,email',
        'mobile'        =>'required|regex:/^1[34578]\d{9}$/|unique:users,mobile',
        'password'      =>'required|confirmed',
        'roles'         =>'array'
    ];

    // passport 多字段验证登陆
    public function findForPassport($username)
    {
        return $this->orWhere('mobile', $username)->orWhere('email', $username)->first();
    }
}
