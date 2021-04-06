<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Enum;

class OrderStatus
{
    public const NEW = 'New';
    public const PARTIALLY_FILL = 'PartiallyFill';
    public const FILL = 'Fill';
    public const CANCELLED = 'Cancelled';
    public const REPLACED = 'Replaced';
    public const PENDING_CANCEL = 'PendingCancel';
    public const REJECTED = 'Rejected';
    public const PENDING_REPLACE = 'PendingReplace';
    public const PENDING_NEW = 'PendingNew';
}
