<?php

declare(strict_types=1);

namespace App\Enums;

enum DocumentsEnums: string
{
    case PO = 'Purchase Order';

    case SALES = 'Sales';

    case ORDERS = 'Orders';

    case TRIPTICKET = 'Trip-ticket';

    case COLLECTION = 'Collection';

    case DEPOSIT = 'Deposit';

    case BOUNCED = 'Bounced';
}
