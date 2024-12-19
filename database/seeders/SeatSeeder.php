<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $totalSeats = 8;
        for ($mejaId = 1; $mejaId <= 6; $mejaId++) {
            for ($seatNum = 1; $seatNum <= $totalSeats; $seatNum++) {
                Seat::create([
                    'seat_number' => "Kursi $seatNum (Meja $mejaId)",
                    'meja_id' => $mejaId,
                ]);
            }
        }
    }
}
