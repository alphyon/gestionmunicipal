<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
