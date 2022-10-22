<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use App\Services\Collections\Interfaces\CollectionPostedResolverInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostCollectionController extends AbstractAPIController
{
    private CollectionPostedResolverInterface $collectionPostedResolver;

    public function __construct(CollectionPostedResolverInterface $collectionPostedResolver) {
        $this->collectionPostedResolver = $collectionPostedResolver;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(int $id): JsonResource
    {
        $collection = Collection::where('id', $id)->first();

        $collection->update([
            'status' => SaleOrderStatusesEnum::POSTED->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $this->collectionPostedResolver->resolve($collection);

        $collection->refresh();

        return new JsonResource($collection);
    }
}
