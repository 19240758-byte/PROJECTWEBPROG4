<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'sender_id',
        'receiver_id',
        'message',
        'is_read',
    ];

    // Hubungan balik ke data Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
