<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password','role','status','mobile_no','address','activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRules(){
        return [
           'name' => 'required|string',
           'password' => 'nullable|string',
           'role' => 'required|in:admin,vendor,user',
           'status' => 'required|in:active,inactive',
           'mobile_no' => 'nullable|string',
           'address' => 'nullable|string'
        ];
    }
    public function getRegisterRules(){
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:vendor,user',
            'address' => 'required|string',
            ''
        ];
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
