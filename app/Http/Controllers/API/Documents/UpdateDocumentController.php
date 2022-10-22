<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Documents;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Documents\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateDocumentController extends AbstractAPIController
{
    public function __invoke(UpdateDocumentRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'document_name',
            'module',
            'description',
            'notes'
        ]);

        $document = Document::find($id);

        if ($request->get('document_name') !== $document->document_name) {

            $exist = Document::where('document_name', $request->get('document_name'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'name' => 'Document name already exist.',
                ), 422);
            }
        }

        $data['updated_by'] = $this->getUser()->getId();

        $document->update($data);

        $document->refresh();

        return new JsonResource($document);
    }
}
