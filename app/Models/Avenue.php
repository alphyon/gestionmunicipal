<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Avenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'course', 'status'
    ];

    public function state(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
