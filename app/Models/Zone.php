<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
         'status',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

}
