<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductTypeEnums: string
{
    case FINISHED_PRODUCT = 'finished_product';

    case RAW_MATERIAL = 'raw_material';
}
