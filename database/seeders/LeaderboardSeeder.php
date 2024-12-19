<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaderboardSeeder extends Seeder
{
    public function run()
    {
        DB::table('leaderboard')->insert([
            [
                'LeaderboardID' => '2024-11-01',
                'nama' => 'Park Jeongwoo',
                'score' => 850,
                'rank' => 1,
                'durasi' => '01:45:00',
                'tanggal' => now(),
            ],
            [
                'LeaderboardID' => '2024-11-02',
                'nama' => 'Kim Jihoon',
                'score' => 780,
                'rank' => 2,
                'durasi' => '01:30:00',
                'tanggal' => now(),
            ],
            [
                'LeaderboardID' => '2024-11-03',
                'nama' => 'Yoon Jaehyuk',
                'score' => 720,
                'rank' => 3,
                'durasi' => '01:15:00',
                'tanggal' => now(),
            ],
        ]);
    }
}
