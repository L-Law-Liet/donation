<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    const TYPES = [
        'card' => 'card',
        'charity_card' => 'charity_card',
        'cash' => 'cash',
        'check' => 'check',
        'pledge' => 'pledge',
        'wallet' => 'wallet',
        'other' => 'other',
    ];

    const STATUSES = [
        'Success' => 'Success',
        'Error' => 'Error',
        'Declined' => 'Declined',
        'Voided' => 'Voided',
        'Refunded' => 'Refunded',
        'Processing' => 'Processing',
        'Deleted' => 'Deleted',
        'Requested' => 'Requested',
    ];

    const PLEDGE_STATUSES = [
      'Open' => 'Open',
      'Partially Paid' => 'Partially Paid',
      'Paid' => 'Paid',
      'Voided' => 'Voided',
      'Running' => 'Running',
    ];

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
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
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
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
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
    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'collector_id');
    }

    /**
     * @return BelongsTo
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
