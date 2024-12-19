<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'meja';

    protected $fillable = [
        'nomor_meja',
        'status',
    ];

    public function reservasi() {
        return $this->hasMany(Reservasi::class, 'meja_id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}