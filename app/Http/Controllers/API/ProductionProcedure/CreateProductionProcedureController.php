<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductionProcedure;

use App\Enums\ProductionProcedureTypesEnum;
use App\Enums\ProductionStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\ProductionProcedure\CreateProductionProcedureRequest;
use App\Http\Resources\ProductionProcedure\ProductionProcedureResource;
use App\Models\ProductionProcedure;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateProductionProcedureController extends AbstractAPIController
{
    public function __invoke(CreateProductionProcedureRequest $request): JsonResource
    {
        $data = $request->all([
            'report_description',
            'procedure_type',
            'total_package_output',
            'total_output',
            'total_rejected',
        ]);

        $data['status'] = ProductionStatusesEnum::CREATED->value;
        $data['created_by'] = $this->getUser()->getId();

        return new ProductionProcedureResource(ProductionProcedure::create($data));
    }
}
