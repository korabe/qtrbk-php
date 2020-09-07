<?php declare(strict_types=1);

namespace QtrBk\QBXML\Queries\Filters;

/**
 * Class DateRange
 * @package QtrBk\QBXML\Queries\Properties
 */
class DateRange implements FilterInterface
{
    const FORMAT = 'Y-m-d';

    protected \DateTimeImmutable $from;

    protected \DateTimeImmutable $to;

    private string $element;

    /**
     * DateRange constructor.
     *
     * @param string $from
     * @param string $to
     * @param string $element
     * @throws \Exception
     */
    public function __construct(string $from, string $to, string $element = 'Txn')
    {
        $this->from = new \DateTimeImmutable($from);
        $this->to = new \DateTimeImmutable($to);
        $this->element = $element;
    }

    /**
     * Returns the QBXML representation of the filter
     *
     * @return string
     */
    public function __toString(): string
    {
       $from = $this->from->format(self::FORMAT);
       $to = $this->to->format(self::FORMAT);
       $element = "{$this->element}DateRangeFilter";
       return "<{$element}><FromTxnDate>{$from}</FromTxnDate><ToTxnDate>{$to}</ToTxnDate></{$element}>";
    }
}