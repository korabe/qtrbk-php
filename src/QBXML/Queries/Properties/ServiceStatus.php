<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class ServiceStatus
 * @package QtrBk\QBXML\Queries\Properties
 * 
 * @method static self Active
 * @method static self Expired
 * @method static self Never
 * @method static self Pending
 * @method static self Suspended
 * @method static self Terminated
 * @method static self Trial
 */
class ServiceStatus extends Months
{
}

