<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats'; 

    protected $fillable = ['seat_number', 'availability'];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
}