<?php

declare(strict_types=1);

namespace App\Enums;

enum PurchaseOrderPaymentTypeEnum: string
{
    case OTHER = 'other';

    case STANDARD = 'standard';
}
