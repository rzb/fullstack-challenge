<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather for all users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::all()->each(fn (User $user) => \App\Jobs\UpdateUserWeather::dispatch($user));
    }
}
