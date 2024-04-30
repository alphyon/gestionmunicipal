<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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


    public function zones(): BelongsTo
    {
        return $this->belongsTo(Zone::class,'zone','id');
    }

    public function streets(): BelongsTo
    {
        return $this->belongsTo(Street::class,'street','id');
    }

    public function colonies(): BelongsTo
    {
        return $this->belongsTo(Colony::class,'colony','id');
    }

    public function avenues(): BelongsTo
    {
        return $this->belongsTo(Avenue::class,'avenue','id');
    }

    public function taxable(): MorphMany
    {
        return $this->morphMany(FeeAssign::class, 'taxable');
    }

    public function coOwners(): HasMany
    {
        return $this->hasMany(CoOwner::class);
    }



}
