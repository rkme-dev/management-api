<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductPackageType;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\ProductPackageType;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductPackageTypeListController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(ProductPackageType::all());
    }
}
