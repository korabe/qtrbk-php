<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class AccountType
 * @package QtrBk\QBXML\Queries\Properties
 *
 * @method static self AccountsPayable
 * @method static self AccountsReceivable
 * @method static self Bank
 * @method static self CostOfGoodsSold
 * @method static self CreditCard
 * @method static self Equity
 * @method static self Expense
 * @method static self FixedAsset
 * @method static self Income
 * @method static self LongTermLiability
 * @method static self NonPosting
 * @method static self OtherAsset
 * @method static self OtherCurrentAsset
 * @method static self OtherCurrentLiability
 * @method static self OtherExpense
 * @method static self OtherIncome
 */
class AccountType extends Enum
{
}

