<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'temperature',
        'perception',
        'precipitation',
        'humidity',
        'wind',
        'pressure',
        'short',
        'full',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
