<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class FirstMonthIncomeTaxYear
 * @package QtrBk\QBXML\Queries\Properties
 * 
 * @method static self Form1040
 * @method static self Form1065
 * @method static self Form1120
 * @method static self Form1120S
 * @method static self Form990
 * @method static self Form990PF
 * @method static self Form990T
 * @method static self OtherOrNone
 */
class TaxForm extends Months
{
}

