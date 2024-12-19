<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leaderboard';
    public $timestamps = false;

    protected $fillable = [
        'LeaderboardID',
        'nama',
        'score',
        'rank',
        'durasi',
        'tanggal'
    ];

    // Relationship to get user reservation durations
    public function reservations()
    {
        return $this->hasMany(Reservasi::class, 'email', 'email'); // Relasi berdasarkan email
    }

    // Calculate total reservation time for a user
    public function calculateTotalReservationTime()
    {
        return $this->reservations->sum(function($reservation) {
            return $reservation->end_time->diffInMinutes($reservation->start_time);
        });
    }
}