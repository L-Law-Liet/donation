<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    use HasFactory;

    const TYPE_TEXT = 'Text Field';
    const TYPE_DROPDOWN = 'Dropdown';

    protected $guarded = [];

    protected $casts = [
        'options' => 'object',
    ];

    /**
     * @return BelongsTo
     */
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
