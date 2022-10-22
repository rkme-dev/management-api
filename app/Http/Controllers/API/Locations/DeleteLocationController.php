<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Locations;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Location;

final class DeleteLocationController extends AbstractAPIController
{
    public function __invoke(int $id)
    {
        $location = Location::find($id);

        $location->update([
            'is_active' => 0,
        ]);

        return $this->respondNoContent();
    }
}
