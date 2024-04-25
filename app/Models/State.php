<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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


}
