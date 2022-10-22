<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Salesman;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListSalesmanController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Salesman::all());
    }
}
