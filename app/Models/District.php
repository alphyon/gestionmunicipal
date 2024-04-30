<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable =[
      'name' ,
      'status'
    ];


    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'district_user','district_id','user_id');
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function zones(): HasMany
    {
        return $this->hasMany(Zone::class);
    }

    public function streets(): HasMany
    {
        return $this->hasMany(Street::class);
    }

    public function avenues(): HasMany
    {
        return $this->hasMany(Avenue::class);
    }

    public function colonies(): HasMany
    {
        return $this->hasMany(Colony::class);
    }

    public function passages(): HasMany
    {
        return $this->hasMany(Passage::class);
    }

    public function owners(): HasMany
    {
        return $this->hasMany(Owner::class);
    }

    public function municipalStates(): HasMany
    {
        return $this->hasMany(MunicipalState::class);
    }

    public function categoryTaxes(): HasMany
    {
        return $this->hasMany(CategoryTax::class);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(Tax::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function spots(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
