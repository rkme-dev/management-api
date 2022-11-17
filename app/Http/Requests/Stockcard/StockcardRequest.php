<?php

declare(strict_types=1);

namespace App\Http\Requests\Stockcard;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

final class StockcardRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getUnit(): ?string
    {
        return $this->getString('unit');
    }

    public function getFromDate(): ?Carbon
    {
        if ($this->get('from_date') === null) {
            return null;
        }

        return new Carbon($this->get('from_date'));
    }

    public function getToDate(): ?Carbon
    {
        if ($this->get('to_date') === null) {
            return null;
        }

        return new Carbon($this->get('to_date'));
    }

    public function rules(): array
    {
       return [
           'unit' => 'string|nullable',
           'from_date' => 'date|nullable',
           'to_date' => 'date|nullable',
       ];
    }
}
