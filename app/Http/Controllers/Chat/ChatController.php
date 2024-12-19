<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Models\Message; // Model untuk pesan
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    // Halaman utama chat
    public function index()
    {
        $messages = Message::with('fromUser')->latest()->take(50)->get()->reverse();
        $user = Auth::user();
        return view('forum.chat', compact('messages', 'user'));
    }

    // API untuk mengambil semua pesan
    public function fetchMessages()
    {
        // Ambil semua pesan, urutkan berdasarkan created_at secara menurun (terbaru pertama)
        $messages = Message::with('fromUser')
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan waktu pembuatan pesan
            ->get();  // Ambil semua pesan
    
        return response()->json(['messages' => $messages]);
    }

    // API untuk mengirim pesan
    public function sendMessage(Request $request)
{
    $request->validate(['message' => 'required|string|max:500']);

    // Simpan pesan ke database
    $message = Message::create([
        'from_user_id' => Auth::id(),
        'message' => $request->message,
    ]);

    return response()->json(['message' => $message], 201);
}

}
