<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductionProcedure;

use App\Enums\ProductionProcedureRequestStatusesEnum;
use App\Enums\ProductionStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\ProductionProcedure\ProductionProcedureRequestCreateRequest;
use App\Http\Resources\ProductionProcedure\ProductionProcedureRequestResource;
use App\Models\ProductionProcedure;
use App\Models\ProductionProcedureRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateProductionProcedureRequestController extends AbstractAPIController
{
    public function __invoke(int $id, ProductionProcedureRequestCreateRequest $request): JsonResource
    {
        $productionProcedure = ProductionProcedure::find($id);

        if ($productionProcedure === null) {
            return $this->respondNotFound('Production Procedure not found.');
        }

        $data = $request->all([
            'production_procedure_id',
            'product_id',
            'total_pieces',
            'total_boxes',
        ]);

        $data['production_procedure_id'] = $productionProcedure->id;
        $data['status'] = ProductionProcedureRequestStatusesEnum::PENDING_REQUEST->value;
        $data['created_by'] = $this->getUser()->getId();

        $productionProcedureRequest = ProductionProcedureRequest::create($data);

        $productionProcedure->setAttribute('status', ProductionStatusesEnum::PENDING_RAW_MATERIALS_REQUEST->value);
        $productionProcedure->save();

        return new ProductionProcedureRequestResource($productionProcedureRequest);
    }
}
