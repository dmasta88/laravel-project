<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Profile;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Profile::firstOrCreate(['user_id' => $user->id], [
            'second_name' => fake()->lastName(),
            'third_name' => fake()->firstName(),
            'avatar' => fake()->imageUrl(),
            'city' => fake()->city(),
            'login' => fake()->userName(),
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
