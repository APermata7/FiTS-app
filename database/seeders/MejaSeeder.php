<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;

class MejaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
            Meja::create([
                'nomor_meja' => "Meja $i",
            ]);
        }
    }
}
