<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'photo',
        'daily_rate',
        'stock',
        'available_stock',
        'category',
        'status'
    ];

    /**
     * Definisikan relasi ke model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
