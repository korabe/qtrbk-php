<?php
declare(strict_types=1);

namespace QtrBk;

use FFI\CData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class QtrBkTest extends TestCase
{
    public function testProcess()
    {
        $sut = $this->buildSubjectUnderTest();
        $xml = $this->getTestXml();
        $this->initializeMockFFI($sut::getFFI());

        $self = $sut->process($xml);
        $this->assertSame($self, $sut);
    }

    public function testHasErrors()
    {
        $sut = $this->buildSubjectUnderTest();
        $this->assertFalse($sut->hasErrors());
        $xml = $this->getTestXml();

        $qb_struct = [
            ['err' =>  0],
            ['err' =>  1],
            ['err' => -1],
        ];

        $this->initializeMockFFI($sut::getFFI(), $qb_struct);

        // err = 0
        $sut->process($xml);
        $this->assertFalse($sut->hasErrors());

        // err = 1
        $sut->process($xml);
        $this->assertTrue($sut->hasErrors());

        // err = -1
        $sut->process($xml);
        $this->assertTrue($sut->hasErrors());
    }

    public function testGetExitCode()
    {
        $sut = $this->buildSubjectUnderTest();
        $expected = 0;
        $actual = $sut->getExitCode();
        $this->assertEquals($expected, $actual);

        $xml = $this->getTestXml();

        $qb_struct = [
            ['err' =>  0],
            ['err' =>  1],
            ['err' => -1],
        ];

        $this->initializeMockFFI($sut::getFFI(), $qb_struct);

        // err = 0
        $sut->process($xml);
        $expected = 0;
        $actual = $sut->getExitCode();
        $this->assertEquals($expected, $actual);

        // err = 1
        $sut->process($xml);
        $expected = 1;
        $actual = $sut->getExitCode();
        $this->assertEquals($expected, $actual);

        // err = -1
        $sut->process($xml);
        $expected = -1;
        $actual = $sut->getExitCode();
        $this->assertEquals($expected, $actual);
    }

    public function testGetErrors()
    {
        $sut = $this->buildSubjectUnderTest();
        $this->assertEmpty($sut->getErrors());

        $xml = $this->getTestXml();

        $qb_struct = [
            ['error' => $this->getCStr('This is an error')],
        ];
        $this->initializeMockFFI($sut::getFFI(), $qb_struct);

        $sut->process($xml);
        $expected = 'This is an error';
        $actual = $sut->getErrors();
        $this->assertEquals($expected, $actual);
    }

    public function testGetQbXmlResponse()
    {
        $sut = $this->buildSubjectUnderTest();
        $this->assertEmpty($sut->getQbXmlResponse());

        $xml = $this->getTestXml();

        $qb_struct = [
            ['response' => $this->getCStr('This is a xml response')],
        ];
        $this->initializeMockFFI($sut::getFFI(), $qb_struct);

        $sut->process($xml);
        $expected = 'This is a xml response';
        $actual = $sut->getQbXmlResponse();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Convert a PHP string to a char[n]
     *
     * @param string $c_str
     * @return CData
     */
    private function getCStr(string $c_str): CData
    {
        $len = strlen($c_str) + 1;
        $cdata = \FFI::new("char[{$len}]");
        \FFI::memcpy($cdata, $c_str, --$len);
        return $cdata;
    }

    /**
     * @return string
     */
    private function getTestXml(): string
    {
        return '<?xml version="1.0"?><test>Foo</test>';
    }

    /**
     * Override the test XML by providing a ['xml' => ...] to the $qb_structs argument.
     * @param MockObject $ffi
     * @param array $qb_structs Override defaults
     */
    private function initializeMockFFI(MockObject $ffi, array $qb_structs = [[]])
    {
        $xml = $this->getTestXml();

        $defaults = [
            'request' => $xml,
            'error' => \FFI::new('char[16]'),
            'response' => null,
            'err' => 0,
        ];

        foreach ($qb_structs as &$struct) {
            $struct = (object)array_merge($defaults, $struct);
        }

        $this_many_times = count($qb_structs);

        $ffi->expects($this->exactly($this_many_times))
            ->method('create_qtrbk')
            ->with($xml)
            ->willReturnOnConsecutiveCalls(...$qb_structs);

        $ffi->expects($this->exactly($this_many_times))
            ->method('process_request');
    }

    /**
     * @return QtrBk
     */
    private function buildSubjectUnderTest()
    {
        $mock_ffi = $this->getMockBuilder(\stdClass::class)
            ->addMethods(['create_qtrbk', 'process_request'])
            ->getMock();

        return new QtrBk($mock_ffi);
    }
}
