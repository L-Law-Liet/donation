<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorTag extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'donor_tag';
}
