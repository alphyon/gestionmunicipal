<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotProduct extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'category',
        'family',
        'spot_id'
    ];
}
