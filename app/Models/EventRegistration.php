<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'is_register',
        'status',
    ];

    // Liên kết với sự kiện
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Liên kết với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'user_id');
    }
}
