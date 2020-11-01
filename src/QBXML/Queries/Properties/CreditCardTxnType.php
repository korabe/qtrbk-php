<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Properties;

use Spatie\Enum\Enum;

/**
 * Class CreditCardTxnType
 * @package QtrBk\QBXML\Queries\Properties
 *
 * @method static self Authorization
 * @method static self Capture
 * @method static self Charge
 * @method static self Refund
 * @method static self VoiceAuthorization
 */
class CreditCardTxnType extends Enum
{
}

