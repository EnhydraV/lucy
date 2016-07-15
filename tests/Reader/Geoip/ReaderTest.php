<?php

namespace Lucy\TestCase\Reader\Geoip;

use Lucy\Reader\Geoip\Reader;
use Lucy\Reader\Geoip\Maxmind;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $reader;

    public function setUp()
    {
        $ip = '175.137.113.75';

        $this->reader = new Reader($ip);
    }

    public function tearDown()
    {
        $this->reader = null;
    }

    public function testGetIpAddressMethod()
    {
        $this->assertEquals('175.137.113.75', $this->reader->getIpAddress());
    }

    public function testGetCountryCodeMethod()
    {
        $this->assertEquals('MY', $this->reader->getCountryCode());
    }

    public function testGetCountryNameMethod()
    {
        $this->assertEquals('Malaysia', $this->reader->getCountryName());
    }
}
