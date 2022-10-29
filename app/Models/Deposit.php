<?php

namespace App\Models;

use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deposit extends Model
{
    use HasFactory, HasRelationshipWithUser;

    protected $fillable = [
        'deposit_number',
        'status',
        'amount',
        'date_posted',
        'clearing_date',
        'remarks',
        'document_id',
        'account_id',
        'created_by',
    ];

    protected $table = 'deposits';

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(CheckPayment::class, 'deposit_id');
    }
}
