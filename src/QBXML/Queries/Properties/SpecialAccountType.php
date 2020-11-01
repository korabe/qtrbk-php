<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;


/**
 * Class SpecialAccountType
 * @package QtrBk\QBXML\Queries\Properties
 *
 * @method static self AccountsPayable
 * @method static self AccountsReceivable
 * @method static self CondenseItemAdjustmentExpenses
 * @method static self CostOfGoodsSold
 * @method static self DirectDepositLiabilities
 * @method static self Estimates
 * @method static self ExchangeGainLoss
 * @method static self InventoryAssets
 * @method static self ItemReceiptAccount
 * @method static self OpeningBalanceEquity
 * @method static self PayrollExpenses
 * @method static self PayrollLiabilities
 * @method static self PettyCash
 * @method static self PurchaseOrders
 * @method static self ReconciliationDifferences
 * @method static self RetainedEarnings
 * @method static self SalesOrders
 * @method static self SalesTaxPayable
 * @method static self UncategorizedExpenses
 * @method static self UncategorizedIncome
 * @method static self UndepositedFunds
 */
class SpecialAccountType extends Enum
{
}

