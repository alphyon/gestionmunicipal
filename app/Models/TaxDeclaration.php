<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaxDeclaration extends Model
{
    use HasFactory;
    protected $fillable =[
        'company_id',
        'net_assets',
        'net_assets_taxable',
        'monthly_amount_tax',
        'date_record',
        'status',
        'district_id'
    ];


    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
