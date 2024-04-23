<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    public function getFullIdentification(): String
    {
        return $this->first_name.' '.$this->last_name .' - '. $this->document;
    }

    public function setFirstNameAttribute($value): void
    {
        $this->attributes['first_name'] = mb_strtoupper($value);
    }
    public function setLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = mb_strtoupper($value);
    }
}
