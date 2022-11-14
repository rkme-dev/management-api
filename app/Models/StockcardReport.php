<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class StockcardReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'morphable_id',
        'morphable_type',
        'product_id',
        'date',
        'event',
        'document',
        'document_number',
        'remarks',
        'quantity',
        'unit',
        'price',
        'status',
        'quantity_in',
        'quantity_out',
        'balance',
    ];

    protected $table = 'stockcard_reports';
}
