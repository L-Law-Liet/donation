<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    const STATUSES = [
      'Not Activated' => 'Not Activated',
      'Activated' => 'Activated',
      'Expired' => 'Expired',
      'De-Activated' => 'De-Activated',
      'Changed Event' => 'Changed Event',
      'Canceled' => 'Canceled',
      'Returned' => 'Returned',
      'Completed' => 'Completed',
    ];

    const DEVICE_TYPES = [
        'All' => 'All',
        'Donary Desktop' => 'Donary Desktop',
        'Printer' => 'Printer',
        'Print Server' => 'Print Server',
        'Donary Phone' => 'Donary Phone',
        'Payment Site' => 'Payment Site',
        'Donary Mobile' => 'Donary Mobile',
        'DRM' => 'DRM',
        'Integrations' => 'Integrations',
        'Scheduler' => 'Scheduler',
        'Donary Donate+' => 'Donary Donate+',
        'Donary Pay' => 'Donary Pay',
        'Donary Donate' => 'Donary Donate',
        'Donary Pocket' => 'Donary Pocket',
        'Donary Dashboard' => 'Donary Dashboard',
        'Rental Kiosk' => 'Rental Kiosk',
        'Donary Event' => 'Donary Event',
        'Imported' => 'Imported',
        'Shul Kiosk' => 'Shul Kiosk',
        'Matbia Site' => 'Matbia Site',
    ];


    /**
     * @return BelongsTo
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * @return BelongsTo
     */
    public function reason(): BelongsTo
    {
        return $this->belongsTo(Reason::class);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function collector(): BelongsTo
    {
        return $this->belongsTo(Donor::class, 'collector_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
