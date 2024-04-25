<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'location',
        'measure',
        'manager',
        'manager_document',
        'status',
        'municipal_state_id',
    ];
}
