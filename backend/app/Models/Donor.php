<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'locations' => 'object',
    ];

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeDonor(Builder $query): void
    {
        $query->where('is_donor', true);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeCollector(Builder $query): void
    {
        $query->where('is_donor', false);
    }

    /**
     * @return BelongsTo
     */
    public function pair(): BelongsTo
    {
        return $this->belongsTo(Donor::class, 'pair_id');
    }

    /**
     * @return BelongsTo
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Donor::class, 'child_id');
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    /**
     * @return HasMany
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    /**
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
