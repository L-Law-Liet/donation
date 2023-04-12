<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPES = [
        'Shul' => 'Shul',
        'Business' => 'Business',
        'Yeshiva' => 'Yeshiva',
        'Toirem_Location' => 'Toirem Location',
        'Catskills' => 'Catskills',
        'Other' => 'Other',
    ];

    protected $guarded = [];
}
