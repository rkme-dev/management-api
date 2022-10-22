<?php

declare(strict_types=1);

namespace App\Enums;

enum PurchaseOrderStatusEnum: string
{
    case PENDING_APPROVAL = 'pending_approval';

    case APPROVED = 'approved';

    case FOR_ARRIVAL = 'for_arrival';

    case PIER_TO_WAREHOUSE = 'pier_to_warehouse';

    case IN_TRANSIT = 'in_transit';

    case ARRIVED = 'arrived';
}
