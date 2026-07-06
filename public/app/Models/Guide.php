<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'bio', 'photo',
        'hourly_rate', 'status', 'is_certified','certificate'
    ];

   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
