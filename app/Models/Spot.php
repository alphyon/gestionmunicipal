<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'owner_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function municipalState()
    {
        return $this->belongsTo(MunicipalState::class, 'municipal_state_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
