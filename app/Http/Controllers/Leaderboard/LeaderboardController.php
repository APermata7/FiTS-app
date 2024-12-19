<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Ambil data Top 3 dari database (contoh tabel leaderboards)
        $leaderboardTop3 = DB::table('leaderboards')
            ->orderBy('score', 'desc')
            ->take(3)
            ->get();

        // Ambil data ranking lainnya
        $otherRankings = DB::table('leaderboards')
            ->orderBy('score', 'desc')
            ->skip(3)
            ->take(10)
            ->get();

        // Kirim data leaderboard ke view
        return view('leaderboard.index', compact('leaderboardTop3', 'otherRankings'));
    }
}
