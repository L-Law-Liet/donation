<?php

namespace App\Observers;

use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

class CampaignObserver
{
    public function creating(Campaign $campaign): void
    {
        $campaign->user()->associate(Auth::user());
        $campaign->num = $campaign->user?->campaigns()?->count() + 1;
    }

    /**
     * Handle the Campaign "created" event.
     */
    public function created(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "updated" event.
     */
    public function updated(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "deleted" event.
     */
    public function deleted(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "restored" event.
     */
    public function restored(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "force deleted" event.
     */
    public function forceDeleted(Campaign $campaign): void
    {
        //
    }
}
