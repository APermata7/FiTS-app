<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'email',
        'meja_id', // Ubah ke foreign key
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
}