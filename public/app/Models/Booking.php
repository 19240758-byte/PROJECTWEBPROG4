<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'guide_id', 'equipment_id', 'booking_date',
        'start_time', 'end_time', 'duration_hours', 'equipment_quantity',
        'guide_cost', 'equipment_cost', 'total_cost', 'notes', 'status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
  public function destination()
{
    // Pastikan destination_id di tabel bookings merujuk ke id di tabel destinations
    return $this->belongsTo(Destination::class, 'destination_id');
}
public function messages()
    {
        return $this->hasMany(Message::class, 'booking_id');
    }
}
