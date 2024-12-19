<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna yang sedang login.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Kirim data pengguna ke view
        return view('profile.profile', compact('user'));
    }

    /**
     * Update profil pengguna, termasuk avatar.
     */
    public function update(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Validasi input (hanya avatar dalam kasus ini)
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Pesan error kustom
            'avatar.image' => 'File yang diunggah harus berupa gambar.',
            'avatar.mimes' => 'Format gambar harus berupa jpeg, png, jpg, atau gif.',
            'avatar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // Proses file avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika ada
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            // Simpan file avatar baru ke storage
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path; // Update path avatar ke database
        }

        $user = Auth::user(); // Ambil user yang sedang login

        // Pastikan $user adalah instance dari User
        if ($user instanceof \App\Models\User) {
            // Ini harus bisa memanggil $user->save()
            $user->save();
        }

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}