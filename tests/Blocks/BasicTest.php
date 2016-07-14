<?php

namespace Lucy\TestCase;

use Lucy\Blocks\Basic;

class BasicTest extends \PHPUnit_Framework_TestCase
{
    protected $block;

    protected $source;

    public function setUp()
    {
        $this->source = '[13/Jul/2016:20:40:38 +0800] xcAcAcAcArAtAc4cFciHAfAz 10.10.2.117 61190 127.0.0.1 80';

        $this->block = new Basic;
    }

    public function tearDown()
    {
        $this->block = null;
    }

    public function testGetBlockIdMethod()
    {
        $this->assertEquals('A', $this->block->getBlockId());
    }

    public function testParseMethod()
    {
        $this->assertInstanceOf('\Lucy\Blocks\Basic', $this->block->parse($this->source));

        $this->assertEquals(13, $this->block->day);
        $this->assertEquals('07', $this->block->month);
        $this->assertEquals(2016, $this->block->year);
        $this->assertEquals(20, $this->block->hour);
        $this->assertEquals(40, $this->block->minutes);
        $this->assertEquals(38, $this->block->seconds);
        $this->assertEquals('+0800', $this->block->timezone);
        $this->assertEquals('xcAcAcAcArAtAc4cFciHAfAz', $this->block->id);
        $this->assertEquals('10.10.2.117', $this->block->clientIp);
        $this->assertEquals('61190', $this->block->sourcePort);
        $this->assertEquals('127.0.0.1', $this->block->serverIp);
        $this->assertEquals('80', $this->block->serverPort);
    }
}
