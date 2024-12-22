<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',          // Tên vai trò
        'description',   // Mô tả vai trò
        'permissions',   // Quyền hạn (JSON)
    ];

    protected $casts = [
        'permissions' => 'array', // Chuyển đổi cột `permissions` thành mảng
    ];

    // Quan hệ với bảng users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

