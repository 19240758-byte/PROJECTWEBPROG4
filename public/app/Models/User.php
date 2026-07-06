<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // WAJIB ADA: supaya sistem tahu ini adalah guide
        'hourly_rate',  // WAJIB ADA: supaya harga tersimpan
        'photo',
        'phone',
        'avatar',
        'bio', // WAJIB ADA: supaya nama file foto tersimpan
    ];

    protected $hidden = ['password'];

    public function guide()
    {
        return $this->hasOne(Guide::class);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

}
