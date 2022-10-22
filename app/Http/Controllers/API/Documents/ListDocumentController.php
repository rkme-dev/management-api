<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Documents;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Document;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListDocumentController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Document::all());
    }
}
