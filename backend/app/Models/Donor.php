<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory;
    use SoftDeletes;

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
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class)->where('primary', true);
    }

    /**
     * @return HasOne
     */
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class)->where('primary', true);
    }

    /**
     * @return HasOne
     */
    public function email(): HasOne
    {
        return $this->hasOne(Email::class)->where('primary', true);
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
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return BelongsToMany
     */
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(FieldValue::class);
    }
}
