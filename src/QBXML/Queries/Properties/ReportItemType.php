<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class ReportItemType
 * @package QtrBk\QBXML\Queries\Properties
 *
 * @method static self AllExceptFixedAsset
 * @method static self Assembly
 * @method static self Discount
 * @method static self FixedAsset
 * @method static self Inventory
 * @method static self InventoryAndAssembly
 * @method static self NonInventory
 * @method static self OtherCharge
 * @method static self Payment
 * @method static self Sales
 * @method static self SalesTax
 * @method static self Service
 */
class ReportItemType extends Enum
{
}

