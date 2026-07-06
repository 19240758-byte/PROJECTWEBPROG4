<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // 1. Daftarkan kolom database yang boleh diisi massal
    protected $fillable = [
        'booking_id',
        'user_id',
        'guide_id',
        'rating',
        'comment'
    ];

    /**
     * 2. Relasi ke Model Booking
     * Mengetahui ulasan ini milik transaksi booking yang mana
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * 3. Relasi ke Model User (Wisatawan)
     * Mengambil data wisatawan yang memberikan ulasan/rating
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 4. Relasi ke Model Guide
     * Mengetahui ulasan ini ditujukan untuk pemandu wisata yang mana
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
