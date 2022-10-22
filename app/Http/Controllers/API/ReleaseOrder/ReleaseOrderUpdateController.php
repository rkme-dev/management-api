<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ReleaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\RawMaterial\CreateRawMaterialReleaseOrderRequest;
use App\Http\Resources\RawMaterial\ReleaseOrderResource;
use App\Models\ProductReleaseOrder;
use App\Models\ReleaseOrder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class ReleaseOrderUpdateController extends AbstractAPIController
{
    public function __invoke(CreateRawMaterialReleaseOrderRequest $request, int $id): JsonResource
    {
        /** @var ReleaseOrder $releaseOrder */
        $releaseOrder = ReleaseOrder::find($id);

        $existingProductItemIds = array_column(
            $releaseOrder->getProductReleaseOrders()->toArray(),
            'id'
        );

        $newProductItemIds = array_column($request->get('raw_materials'), 'id');

        $idsToDelete = array_diff($existingProductItemIds, $newProductItemIds);

        ProductReleaseOrder::whereIn('id', $idsToDelete)->delete();

        foreach ($request->get('raw_materials') ?? [] as $rawMaterial) {
            if (Arr::get($rawMaterial, 'id') === null) {
                $rawMaterial['release_order_id'] = $releaseOrder->id;
                $rawMaterial['created_by'] = $this->getUser()->id;

                ProductReleaseOrder::create($rawMaterial);

                continue;
            }

            $productReleaseOrder = ProductReleaseOrder::find(Arr::get($rawMaterial, 'id'));

            $productReleaseOrder->update($rawMaterial);
        }

        $releaseOrder->refresh();

        return new ReleaseOrderResource($releaseOrder);
    }
}
