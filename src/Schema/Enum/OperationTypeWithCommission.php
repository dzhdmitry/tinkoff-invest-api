<?php

namespace Dzhdmitry\TinkoffInvestApi\Schema\Enum;

class OperationTypeWithCommission
{
    public const BUY = 'Buy';
    public const BUY_CARD = 'BuyCard';
    public const SELL = 'Sell';
    public const BROKER_COMMISSION = 'BrokerCommission';
    public const EXCHANGE_COMMISSION = 'ExchangeCommission';
    public const SERVICE_COMMISSION = 'ServiceCommission';
    public const MARGIN_COMMISSION = 'MarginCommission';
    public const OTHER_COMMISSION = 'OtherCommission';
    public const PAY_IN = 'PayIn';
    public const PAY_OUT = 'PayOut';
    public const TAX = 'Tax';
    public const TAX_LUCRE = 'TaxLucre';
    public const TAX_DIVIDEND = 'TaxDividend';
    public const TAX_COUPON = 'TaxCoupon';
    public const REPAYMENT = 'Repayment';
    public const PART_REPAYMENT = 'PartRepayment';
    public const COUPON = 'Coupon';
    public const DIVIDEND = 'Dividend';
    public const SECURITY_IN = 'SecurityIn';
    public const SECURITY_OUT = 'SecurityOut';
}
