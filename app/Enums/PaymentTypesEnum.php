<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentTypesEnum: string
{
    case CASH_PAYMENT = 'cash_payment';

    case CHECK_PAYMENT = 'check_payment';

    case ONLINE_PAYMENT = 'online_payment';
}
