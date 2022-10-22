<?php

namespace App\Models;

use App\Enums\ProductionProcedureRequestStatusesEnum;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ProductionProcedureRequest extends Model
{
    use HasFactory, HasRelationshipWithUser;

    protected $casts = [
        'status' => ProductionProcedureRequestStatusesEnum::class,
    ];

    protected $fillable = [
        'status',
        'production_procedure_id',
        'product_id',
        'total_pieces',
        'total_boxes',
        'created_by',
        'released_by',
        'updated_by',
    ];

    protected $table = 'production_procedure_requests';

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getProductionProcedure(): ProductionProcedure
    {
        return $this->productionProcedure;
    }

    public function getReleasedBy(): ?User
    {
        return $this->releasedBy;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productionProcedure(): BelongsTo
    {
        return $this->belongsTo(ProductionProcedure::class, 'production_procedure_id');
    }

    public function releasedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'released_by');
    }

}
