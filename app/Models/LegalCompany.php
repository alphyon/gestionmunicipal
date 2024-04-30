<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegalCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_names',
        'last_name',
        'type',
        'identity_number',
        'document_type',
        'email',
        'phone',
        'address',
        'company_id',
        'district_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
