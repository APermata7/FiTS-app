<?php

namespace App\Http\Controllers\Reservasi;

use App\Models\Meja;
use App\Models\Reservasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $meja = Meja::all();
        return view('reservasi.index', compact('meja'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'meja_id' => 'required|exists:meja,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]); 

        $meja = Meja::with('seats')->where('nomor_meja', $request->meja)->first();
        if (!$meja) {
            return response()->json([
                'success' => false,
                'message' => 'Meja tidak ditemukan.',
            ], 404);
        }
        $validated['meja_id'] = $meja->id;

        $existingReservations = Reservasi::where('meja_id', $meja->id)
        ->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('waktu_mulai', '<', $request->waktu_selesai)
                  ->where('waktu_selesai', '>', $request->waktu_mulai);
            });
        })->exists();    
    
        if ($existingReservations) {
            return response()->json([
                'success' => false,
                'message' => 'Meja sudah dipesan untuk waktu ini.'
            ], 422);
        }
    
        Reservasi::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'email' => $validated['email'],
            'meja_id' => $validated['meja_id'],
            'tanggal' => $validated['tanggal'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
        ]);        
    
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil.',
            'redirect_url' => route('reservasi.status'),
        ]);
    }

    public function getMejaDetails($id)
    {
        $meja = Meja::with('seats')->findOrFail($id);
        return response()->json($meja);
    }

    public function showStatus()
    {
        $meja = Meja::with('seats')->get();
        return view('reservasi.status', compact('meja'));
    }

}