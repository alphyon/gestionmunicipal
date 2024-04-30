<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'status',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
