<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Quan hệ với bảng roles
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Quan hệ với bảng user_details
    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }
}
