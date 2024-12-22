<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'abbreviation', 'description'];

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'unit_id');
    }
}
