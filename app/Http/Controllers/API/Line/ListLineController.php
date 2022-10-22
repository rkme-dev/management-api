<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Line;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Line;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListLineController extends AbstractAPIController
{
    public function __invoke()
    {
        return new JsonResource(Line::all());
    }
}
