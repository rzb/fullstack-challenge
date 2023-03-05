<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Clients\Client;

class UpdateUserWeather implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user)
    {}

    /**
     * Execute the job.
     */
    public function handle(Client $client): void
    {
        $this->user->weather()->updateOrCreate(
            (array) $client->currentWeather($this->user)
        );
    }
}
