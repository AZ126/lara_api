<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class CreateWallet
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        Wallet::create([
            'uuid' => (string) Str::uuid(),
            'user_id' =>$event->user->id,
            'currency' => 'USD',
            'balance' => 0,
            'status' => 'active',
        ]);
    }
}
