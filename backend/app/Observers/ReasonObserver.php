<?php

namespace App\Observers;

use App\Models\Reason;
use Illuminate\Support\Facades\Auth;

class ReasonObserver
{
    public function creating(Reason $reason)
    {
        $reason->user()->associate(Auth::user());
    }
    /**
     * Handle the Reason "created" event.
     */
    public function created(Reason $reason): void
    {
        //
    }

    /**
     * Handle the Reason "updated" event.
     */
    public function updated(Reason $reason): void
    {
        //
    }

    /**
     * Handle the Reason "deleted" event.
     */
    public function deleted(Reason $reason): void
    {
        //
    }

    /**
     * Handle the Reason "restored" event.
     */
    public function restored(Reason $reason): void
    {
        //
    }

    /**
     * Handle the Reason "force deleted" event.
     */
    public function forceDeleted(Reason $reason): void
    {
        //
    }
}
