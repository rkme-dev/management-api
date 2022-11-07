<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Deposits;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\CollectionPayment;
use App\Models\CollectionPaymentTypes\CheckPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListCheckPaymentController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResource
    {
        $id = $request->get('id') ?? null;

        $collectionPayment = CollectionPayment::whereHas('collection', function ($query) {
            $query->where('status', SaleOrderStatusesEnum::POSTED);
        })
            ->where('payment_type', 'App\Models\CollectionPaymentTypes\CheckPayment')
            ->get();

        $collectionPaymentIds = array_column($collectionPayment->toArray(), 'payment_id');

        $checks = CheckPayment::with(['collectionPayment', 'collection'])
            ->whereIn('id', $collectionPaymentIds)
            ->whereNull('deposit_id')->get();
//        $checks = CheckPayment::with(['collectionPayment', 'collection'])
//            ->whereHas('collection', function ($query) {
//                $query->where('status', SaleOrderStatusesEnum::POSTED);
//            })
//            ->whereNull('deposit_id')
//            ->get();

        if ($id !== null) {
//            $checks = CheckPayment::with(['collectionPayment', 'collection'])
//                ->whereHas('collection', function ($query) {
//                    $query->where('status', SaleOrderStatusesEnum::POSTED);
//                })
//                ->where('deposit_id', $id)
//                ->get();

            $checks = CheckPayment::where('deposit_id', $id)
            ->with([
                'collectionPayment',
                'collection',
            ])->get();
        }

        return new JsonResource($checks);
    }
}
