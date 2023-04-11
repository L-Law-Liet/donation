<?php

namespace App\Observers;

use App\Models\Donor;

class DonorObserver
{

    public function creating(Donor $donor)
    {
        if (!$donor->locations) {
            $donor->locations = [];
        }
    }
    /**
     * Handle the Donor "created" event.
     */
    public function created(Donor $donor): void
    {
        //
    }

    /**
     * Handle the Donor "updated" event.
     */
    public function updated(Donor $donor): void
    {
        //
    }

    /**
     * Handle the Donor "deleted" event.
     */
    public function deleted(Donor $donor): void
    {
        //
    }

    /**
     * Handle the Donor "restored" event.
     */
    public function restored(Donor $donor): void
    {
        //
    }

    /**
     * Handle the Donor "force deleted" event.
     */
    public function forceDeleted(Donor $donor): void
    {
        //
    }
}
