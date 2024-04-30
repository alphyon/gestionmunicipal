<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    use HasFactory;

    protected $fillable =[
        'first_name',
        'last_name',
        'AKA',
        'document',
        'doc_type',
        'email',
        'phone',
        'isr',
        'status',
        'district_id'
    ];
    public function getFullIdentificationAttribute(): String
    {
        return $this->first_name.' '.$this->last_name .' - '. $this->document;
    }

    public function getFullNameAttribute(): String
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function setFirstNameAttribute($value): void
    {
        $this->attributes['first_name'] = mb_strtoupper($value);
    }
    public function setLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = mb_strtoupper($value);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
