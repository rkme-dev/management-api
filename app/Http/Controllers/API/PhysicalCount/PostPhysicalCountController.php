<?php

namespace App\Http\Controllers\API\PhysicalCount;

use App\Enums\PhysicalCountStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Jobs\Collection\ProductInitializeInventoryJob;
use App\Jobs\Reports\CreateStockcardReportJob;
use App\Models\PhysicalCount;
use App\Services\InventoryService\Resources\CreateStockcardResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class PostPhysicalCountController extends AbstractAPIController
{
    public function __invoke(PhysicalCount $physicalCount): JsonResource
    {
        $physicalCount->load('countItems')
            ->update([
                'status' => PhysicalCountStatusesEnum::POSTED->value,
                'updated_by' => $this->getUser()->getId(),
            ]);

        $physicalCount->refresh();

        foreach ($physicalCount->getItems() as $item) {
            CreateStockcardReportJob::dispatch(new CreateStockcardResource([
                'event' => 'Physical',
                'type' => get_class($item),
                'typeId' => $item->getAttribute('id'),
                'productId' => $item->getAttribute('product_id'),
                'date' => $physicalCount->getAttribute('date_posted'),
                'document' => $physicalCount->document->getAttribute('document_name'),
                'documentNumber' => (string) $physicalCount->document->getAttribute('id'),
                'remarks' => $physicalCount->getAttribute('remarks'),
                'quantity' => $item->getAttribute('quantity'),
                'unit' => $item->getAttribute('unit'),
                'price' => (string) $item->getAttribute('cost'),
                'quantityIn' => $item->getAttribute('quantity'),
                'quantityOut' => '0',
                'balance' => $item->getAttribute('quantity'),
                'status' => 'posted',
            ]));

            ProductInitializeInventoryJob::dispatch(
                Arr::get($item, 'product_id'),
                Arr::get($item, 'unit'),
                Arr::get($item, 'quantity')
            );
        }

        return new JsonResource($physicalCount);
    }
}
