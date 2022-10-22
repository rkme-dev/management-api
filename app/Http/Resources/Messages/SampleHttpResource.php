<?php

declare(strict_types=1);

namespace App\Http\Resources\StatementOrders;

use App\Http\Resources\Resource;

final class SampleHttpResource extends Resource
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * @return mixed[]
     */
    protected function getResponse(): array
    {
        return [
            'message' => $this->resource,
        ];
    }
}
