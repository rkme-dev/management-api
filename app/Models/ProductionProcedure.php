<?php

namespace App\Models;

use App\Enums\ProductionProcedureTypesEnum;
use App\Enums\ProductionStatusesEnum;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ProductionProcedure extends Model
{
    use HasFactory, HasRelationshipWithUser, SoftDeletes;

    protected $casts = [
        'procedure_type' => ProductionProcedureTypesEnum::class,
        'status' => ProductionStatusesEnum::class,
    ];

    protected $fillable = [
        'report_description',
        'procedure_type',
        'status',
        'total_package_output',
        'total_output',
        'total_rejected',
        'created_by',
        'updated_by',
        'received_by',
        'released_by',
    ];

    protected $table = 'production_procedures';

    public function getProductionProcedureRequests(): Collection
    {
        return $this->productionProcedureRequests;
    }

    public function getReceivedBy(): ?User
    {
        return $this->receivedBy;
    }

    public function getReleasedBy(): ?User
    {
        return $this->releasedBy;
    }

    public function productionProcedureRequests(): HasMany
    {
        return $this->hasMany(ProductionProcedureRequest::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function releasedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'released_by');
    }
}
