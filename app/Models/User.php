<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; 
    protected $fillable = [
        'name',
        'profile',
        'email',
        'password',  
        'typeUser',  // 1: Comum, 2: Investidor, 3: Startup, 4: Admin
        'cit',
        'UF',
        'tel',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function startups()
    {
        return $this->hasMany(Startup::class, 'user_id');
    }
}
