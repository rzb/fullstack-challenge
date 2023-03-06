<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherReport extends Model
{
    use HasFactory;
    use BroadcastsEvents;

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

    public function broadcastOn(string $event): array
    {
        return match ($event) {
            'updated' => [new Channel('weather')],
            default => [],
        };
    }
}
