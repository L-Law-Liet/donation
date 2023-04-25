<?php

namespace App\Observers;

use App\Models\Donor;
use Illuminate\Support\Facades\Auth;

class DonorObserver
{
    public function creating(Donor $donor)
    {
        $donor->user()->associate(Auth::user());
        $donor->yid_fullname = implode(' ', [$donor->yid_name1, $donor->yid_name2]);
        $donor->fullname = implode(' ', [$donor->eng_pre, $donor->eng_name1, $donor->eng_name2]);
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
