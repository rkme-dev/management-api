<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Enums\PurchaseOrderStatusEnum;
use App\Events\MessageEvent;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PurchaseOrder\PurchaseOrderCreateRequest;
use App\Models\OrderItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderLogs;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

final class PurchaseOrderCreateController extends AbstractAPIController
{
    public function __invoke(PurchaseOrderCreateRequest $request): JsonResponse
    {
        $items = $request->get('items');

        $status = PurchaseOrderStatusEnum::PENDING_APPROVAL->value;

        $default = [
            'active' => 1,
            'number' => Str::uuid(),
            'status' => $status,
        ];

        $params = \array_merge($default, $request->all());

        $order = PurchaseOrder::create($params);

        $this->setOrderItems($order, $items);

        $notification = \sprintf('Purchase Order: %s, is ready for approval.', $order->getAttribute('id'));

        MessageEvent::dispatch($notification);

        $this->attachLogs($order->getAttribute('id'), $request->user()->getAttribute('id'), $status);

        return $this->respondCreated([
            'data' => $order, // create dto for order details and items
        ]);
    }

    private function setOrderItems(PurchaseOrder $order, array $items): void
    {
        foreach ($items as $item) {
            $orderItem = new OrderItem();
            $orderItem->setAttribute('product_id', $item['product_id']);
            $orderItem->setAttribute('quantity', $item['quantity']);
            $orderItem->setAttribute('orderable_id', $order->getAttribute('id'));
            $orderItem->setAttribute('orderable_type', $order::class);

            $orderItem->save();
        }
    }

    private function attachLogs(int $id, int $userId, string $updateStatus) {
        PurchaseOrderLogs::create([
            'message' => \sprintf('Purchase Order: %s has been created', $id),
            'status' => $updateStatus,
            'order_id' => $id,
            'user_id' => $userId,
            'action' => 'Created'
        ]);
    }
}
