<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'incomes';

    /**
     * Kolom yang boleh diisi secara massal.
     * Sesuaikan dengan kolom yang ada di database Anda.
     */
   protected $fillable = [
    'user_id',
    'nama_pelanggan',
    'tanggal',
    'durasi',
    'biaya',
    'status',
];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    /**
     * Relasi ke User (Guide).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
