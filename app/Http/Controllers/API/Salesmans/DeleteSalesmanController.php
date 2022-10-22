<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Salesman;

final class DeleteSalesmanController extends AbstractAPIController
{
    public function __invoke(int $id)
    {
        $salesman = Salesman::find($id);

        $salesman->update([
            'is_active' => 0,
        ]);

        return $this->respondNoContent();
    }
}
