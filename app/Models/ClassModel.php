<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // Tên bảng
    protected $fillable = ['class_name', 'faculty_id']; // Các cột có thể gán

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
