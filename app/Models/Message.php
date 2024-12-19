<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from_user_id', 'message'];

    // Relasi ke user
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}

