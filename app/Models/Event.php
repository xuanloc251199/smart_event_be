<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'start_time',
        'end_time',
        'location',
        'thumbnail',
        'description',
        'category_id',
        'faculty_id',
    ];

    // Liên kết với danh mục
    public function category()
    {
        return $this->belongsTo(Category::class,  'category_id');
    }

    // Liên kết với khoa
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    // Liên kết với đăng ký sự kiện
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
