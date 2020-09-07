<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QtrBk\QBXML\Queries\Filters\DateRange;

class DateRangeTest extends TestCase
{
    public function testToString()
    {
        $sut = new DateRange('1/1/2020', '1/31/2020');
        $expected = '<TxnDateRangeFilter><FromTxnDate>2020-01-01</FromTxnDate><ToTxnDate>2020-01-31</ToTxnDate></TxnDateRangeFilter>';
        $actual = (string)$sut;
        $this->assertEquals($expected, $actual);

        $sut = new DateRange('Jan 01, 2020', 'Jan 31, 2020', 'Transaction');
        $expected = '<TransactionDateRangeFilter><FromTxnDate>2020-01-01</FromTxnDate><ToTxnDate>2020-01-31</ToTxnDate></TransactionDateRangeFilter>';
        $actual = (string)$sut;
        $this->assertEquals($expected, $actual);
    }
}