<?php

namespace App\Models;

use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BouncedDeposit extends Model
{
    use HasFactory, HasRelationshipWithUser;

    protected $fillable = [
        'bounced_number',
        'status',
        'amount',
        'date_posted',
        'clearing_date',
        'remarks',
        'document_id',
        'account_id',
        'created_by',
    ];

    protected $table = 'bounced_deposits';

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
        return $this->hasMany(CheckPayment::class, 'bounced_deposit_id');
    }
}
