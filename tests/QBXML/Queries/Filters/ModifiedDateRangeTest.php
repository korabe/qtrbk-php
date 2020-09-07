<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use QtrBk\QBXML\Queries\Filters\DateRange;
use QtrBk\QBXML\Queries\Filters\ModifiedDateRange;

class ModifiedDateRangeTest extends TestCase
{
    public function testToString()
    {
        $sut = new ModifiedDateRange('1/1/2020', '1/31/2020');
        $expected = '<ModifiedDateRangeFilter><FromModifiedDate>2020-01-01</FromModifiedDate><ToModifiedDate>2020-01-31</ToModifiedDate></ModifiedDateRangeFilter>';
        $actual = (string)$sut;
        $this->assertEquals($expected, $actual);

        $sut = new ModifiedDateRange('Jan 01, 2020', 'Jan 31, 2020');
        $actual = (string)$sut;
        $this->assertEquals($expected, $actual);
    }
}