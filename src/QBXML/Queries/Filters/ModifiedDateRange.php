<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Filters;

/**
 * Class ModifiedDateRange
 * @package QtrBk\QBXML\Queries\Filters
 */
class ModifiedDateRange extends DateRange
{
    /**
     * Returns QBXML representation of the filter
     *
     * @return string
     */
    public function __toString(): string
    {
        $from = $this->from->format(self::FORMAT);
        $to = $this->to->format(self::FORMAT);
        return "<ModifiedDateRangeFilter><FromModifiedDate>{$from}</FromModifiedDate><ToModifiedDate>{$to}</ToModifiedDate></ModifiedDateRangeFilter>";
    }
}