<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'status',
        'date_init',
        'date_end',
        'period',
        'adjust',
        'tax_id',
    ];

    public function taxes(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
