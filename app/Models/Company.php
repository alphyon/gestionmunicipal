<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use PhpParser\Builder\Declaration;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'commercial_name',
        'commercial_activity',
        'file',
        'type',
        'NRC',
        'NIT',
        'email',
        'status',
        'address',
        'street',
        'avenue',
        'passage',
        'colony',
        'block',
        'num_house',
        'reference',
        'phone',
        'operation_start',
        'declare',
    ];


    public function taxable(): MorphMany
    {
        return $this->morphMany(FeeAssign::class, 'taxable');
    }

    public function taxDeclaration(): HasMany
    {
       return $this->hasMany(TaxDeclaration::class,'company_id','id');
    }

    public function legals(): HasMany
    {
        return $this->hasMany(LegalCompany::class,'company_id','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

}
