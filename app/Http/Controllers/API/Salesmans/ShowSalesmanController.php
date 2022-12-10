<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Salesman;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowSalesmanController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(Salesman::find($id));
    }
}
