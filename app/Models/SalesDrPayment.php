<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDrPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_to_pay',
        'sales_dr_id',
        'collection_id',
        'created_by',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function salesDr(): BelongsTo
    {
        return $this->belongsTo(SalesDr::class);
    }
}
