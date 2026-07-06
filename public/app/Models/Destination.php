<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'photo', 'distance_from_purwokerto',
        'difficulty_level', 'category', 'guide_recommended'
    ];

    protected $casts = [
        'difficulty_level' => 'decimal:1',
        'guide_recommended' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($destination) {
            $destination->slug = Str::slug($destination->name);
        });
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
