<?php

declare(strict_types=1);

namespace App\Enums;

enum RawMaterialTypeEnums: string
{
    case PREFORM = 'preform';

    case BOTTLE_CAP = 'bottle_cap';

    case BOTTLE_LABEL = 'bottle_label';

    case BLOWN_BOTTLE = 'blown_bottle';
}
