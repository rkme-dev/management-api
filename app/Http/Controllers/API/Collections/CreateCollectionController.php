<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Enums\PaymentTypesEnum;
use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Collection\CreateCollectionRequest;
use App\Models\Collection;
use App\Models\OrderItem;
use App\Models\SalesDr;
use App\Models\SalesDrPayment;
use App\Models\User;
use App\Services\CollectionPayments\Interfaces\CollectionPaymentFactoryInterface;
use App\Services\CollectionPayments\Interfaces\CollectionTypeFactoryResolverInterface;
use App\Services\CollectionPayments\Resources\CreateCollectionPaymentResource;
use App\Services\CollectionPayments\Resources\CreatePaymentTypeResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class CreateCollectionController extends AbstractAPIController
{
    private CollectionPaymentFactoryInterface $collectionPaymentFactory;

    private CollectionTypeFactoryResolverInterface $collectionTypeFactoryResolver;

    public function __construct(
        CollectionPaymentFactoryInterface $collectionPaymentFactory,
        CollectionTypeFactoryResolverInterface $collectionTypeFactoryResolver
    ) {
        $this->collectionPaymentFactory = $collectionPaymentFactory;
        $this->collectionTypeFactoryResolver = $collectionTypeFactoryResolver;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(CreateCollectionRequest $request): JsonResource
    {
        $collection = Collection::create([
            ...$request->all([
                'remarks',
                'customer_id',
                'document_id',
                'salesman_id_1',
                'salesman_id_2',
                'term_id',
                'vat_id',
                'qr_code',
                'promo_code',
                'amount',
            ]),
            ...[
                'date_posted' => $this->generateDateTime($request->get('date_posted')),
                'collection_order_number' => $this->generateNumber('collections', 'OR'),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $this->createSalesDrPayments(
            $collection,
            $this->getUser(),
            $request->get('dr_items')
        );

        $this->createCollectionPayments(
            $collection,
            $this->getUser(),
            $request->get('payment_items')
        );

        $this->createOrderItems(
            $collection,
            $request->get('dr_items')
        );

        return new JsonResource($collection);
    }

    private function createOrderItems(Collection $collection, array $salesDr): void
    {
        $salesDrIds = array_column($salesDr, 'id') ?? [];

        $orderItems = OrderItem::whereHasMorph('orderable', [SalesDr::class], function ($query) use ($salesDrIds) {
            $query->whereIn('id', $salesDrIds);
        })->get();

        // Basically convert Sales DR items to Collection Items
        foreach ($orderItems as $orderItem) {
            $orderDrItem = new OrderItem();
            $orderDrItem->setAttribute('orderable_type', $collection::class);
            $orderDrItem->setAttribute('orderable_id', $collection->getAttribute('id'));
            $orderDrItem->setAttribute('product_id', $orderItem->getAttribute('product_id'));
            $orderDrItem->setAttribute('quantity', $orderItem->getAttribute('quantity'));
            $orderDrItem->setAttribute('unit', $orderItem->getAttribute('unit'));
            $orderDrItem->setAttribute('actual_quantity', $orderItem->getAttribute('actual_quantity'));
            $orderDrItem->setAttribute('total_amount', $orderItem->getAttribute('total_amount'));
            $orderDrItem->setAttribute('price',  $orderItem->getAttribute('price'));
            $orderDrItem->save();
        }
    }

    private function createSalesDrPayments(
        Collection $collection,
        User $user,
        array $salesDrs
    ): void {
        foreach ($salesDrs as $salesDr) {
            SalesDrPayment::create([
                'collection_id' => $collection->getAttribute('id'),
                'created_by' => $user->getAttribute('id'),
                'amount_to_pay' => Arr::get($salesDr, 'amount_to_pay'),
                'sales_dr_id' => Arr::get($salesDr, 'id'),
            ]);
        }
    }

    /**
     * @throws \Exception
     */
    private function createCollectionPayments(
        Collection $collection,
        User $user,
        array $payments,
    ): void
    {
        foreach ($payments as $payment) {
            $type = PaymentTypesEnum::from(Arr::get($payment, 'type'));

            $driver = $this->collectionTypeFactoryResolver->resolve($type);

            $paymentType = $driver->make(new CreatePaymentTypeResource([
                'bank' => Arr::get($payment, 'bank'),
                'bankAccountNumber' => Arr::get($payment, 'bank_account_number'),
                'checkType' => Arr::get($payment, 'check_type'),
                'checkNumber' => Arr::get($payment, 'check_number'),
                'modeOfTransfer' => Arr::get($payment, 'mode_of_transfer'),
                'transactionNumber' => Arr::get($payment, 'transaction_number'),
            ]));

            $this->collectionPaymentFactory->make(new CreateCollectionPaymentResource([
                'collection' => $collection,
                'accountId' => Arr::get($payment, 'account_id'),
                'type' => $paymentType,
                'paymentDate' => new Carbon(Arr::get($payment,'payment_date')),
                'createdBy' => $user,
                'amount' => Arr::get($payment, 'amount'),
            ]));
        }
    }
}
