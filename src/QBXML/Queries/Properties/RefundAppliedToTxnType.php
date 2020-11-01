<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class RefundAppliedToTxnType
 * @package QtrBk\QBXML\Queries\Properties
 *
 * @method static self ARRefundCreditCard
 * @method static self Bill
 * @method static self BillPaymentCheck
 * @method static self BillPaymentCreditCard
 * @method static self BuildAssembly
 * @method static self Charge
 * @method static self Check
 * @method static self CreditCardCharge
 * @method static self CreditCardCredit
 * @method static self CreditMemo
 * @method static self Deposit
 * @method static self Estimate
 * @method static self InventoryAdjustment
 * @method static self Invoice
 * @method static self ItemReceipt
 * @method static self JournalEntry
 * @method static self LiabilityAdjustment
 * @method static self Paycheck
 * @method static self PayrollLiabilityCheck
 * @method static self PurchaseOrder
 * @method static self ReceivePayment
 * @method static self SalesOrder
 * @method static self SalesReceipt
 * @method static self SalesTaxPaymentCheck
 * @method static self Transfer
 * @method static self VendorCredit
 * @method static self YTDAdjustment
 */
class RefundAppliedToTxnType extends Enum
{
}

