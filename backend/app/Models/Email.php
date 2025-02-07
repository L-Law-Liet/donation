<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_DEFAULT = 'DEFAULT';
    const TYPE_HOME = 'HOME';
    const TYPE_WORK = 'WORK';

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
