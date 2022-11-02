<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use App\Services\Collections\Interfaces\CollectionUnpostResolverInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnPostCollectionController extends AbstractAPIController
{
    private CollectionUnpostResolverInterface $collectionUnpostResolver;

    public function __construct(CollectionUnpostResolverInterface $collectionUnpostResolver) {
        $this->collectionUnpostResolver = $collectionUnpostResolver;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(int $id): JsonResource
    {
        $collection = Collection::where('id', $id)->first();

        $collection->update([
            'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $collection->refresh();

        $this->collectionUnpostResolver->resolve($collection);

        return new JsonResource($collection);
    }
}
