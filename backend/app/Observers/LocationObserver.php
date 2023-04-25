<?php

namespace App\Observers;

use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class LocationObserver
{
    public function creating(Location $location)
    {
        $location->user()->associate(Auth::user());
    }
    /**
     * Handle the Location "created" event.
     */
    public function created(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "updated" event.
     */
    public function updated(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "deleted" event.
     */
    public function deleted(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "restored" event.
     */
    public function restored(Location $location): void
    {
        //
    }

    /**
     * Handle the Location "force deleted" event.
     */
    public function forceDeleted(Location $location): void
    {
        //
    }
}
