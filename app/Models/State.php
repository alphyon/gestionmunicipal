<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'status',
        'zone',
        'NIS',
        'file',
        'street',
        'avenue',
        'colony',
        'passage',
        'block',
        'number_house',
        'reference',
        'register',
        'measure',
        'owner_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function state_owner(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class, 'state_owners', 'state_id', 'owner_id');
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    public function colony(): BelongsTo
    {
        return $this->belongsTo(Colony::class);
    }

    public function avanue(): BelongsTo
    {
        return $this->belongsTo(Avenue::class);
    }




}
