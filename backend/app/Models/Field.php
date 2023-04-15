<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_TEXT = 'Text';
    const TYPE_DROPDOWN = 'Dropdown';

    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
    ];

    public function scopeDropdown($q)
    {
        $q->where('type', self::TYPE_DROPDOWN);
    }

    public function scopeText($q)
    {
        $q->where('type', self::TYPE_TEXT);
    }

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(FieldValue::class);
    }
}
