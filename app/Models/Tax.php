<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'type',
        'category_tax_id',
    ];

    public function categoryTax(): BelongsTo
{
    return $this->belongsTo(CategoryTax::class);
}
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }


}
