<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'commercial_name',
        'commercial_activity',
        'file',
        'type',
        'NRC',
        'NIT',
        'email',
        'status',
        'address',
        'street',
        'avenue',
        'passage',
        'colony',
        'block',
        'num_house',
        'reference',
        'phone',
        'operation_start',
        'declare',
    ];
}
