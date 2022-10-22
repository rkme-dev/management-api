<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ReleaseOrder;

use App\Enums\ReleaseOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\RawMaterial\CreateRawMaterialReleaseOrderRequest;
use App\Http\Resources\RawMaterial\ReleaseOrderResource;
use App\Models\Product;
use App\Models\ProductReleaseOrder;
use App\Models\ReleaseOrder;
use Illuminate\Http\Resources\Json\JsonResource;

final class ReleaseOrderCreateController extends AbstractAPIController
{
    public function __invoke(CreateRawMaterialReleaseOrderRequest $request): JsonResource
    {
        try {
            $releaseOrder = ReleaseOrder::create([
                'status' => ReleaseOrderStatusesEnum::PENDING_REQUEST->value,
                'created_by' => $this->getUser()->getId(),
            ]);
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }

        foreach ($request->get('raw_materials') as $rawMaterial) {
            $rawMaterial['release_order_id'] = $releaseOrder->id;
            $rawMaterial['created_by'] = $this->getUser()->id;

            ProductReleaseOrder::create($rawMaterial);
        }

        return new ReleaseOrderResource($releaseOrder);
    }
}
