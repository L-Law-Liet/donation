<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function donors(): BelongsToMany
    {
        return $this->belongsToMany(Donor::class);
    }

    /**
     * @return BelongsTo
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
