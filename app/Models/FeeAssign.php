<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeAssign extends Model
{
    use HasFactory;
    protected $table ='fee_assigns';
    protected $fillable =[
        'taxable_type',
        'taxable_id',
        'fee_id',
        'cycle_days',
        'expiration',
        'district_id'
    ];

    public function taxable(): \Illuminate\Database\Eloquent\Relations\MorphTo{
        return $this->morphTo();
    }

    public function fee() :BelongsTo
    {
        return $this->belongsTo(Fee::class,'fee_id','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
