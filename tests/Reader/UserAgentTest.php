<?php

namespace Lucy\TestCase\Reader;

use Lucy\Reader\UserAgent;

class UserAgentTest extends \PHPUnit_Framework_TestCase
{
    protected $agent;

    public function setUp()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36';

        $this->agent = new UserAgent($userAgent);
    }

    public function tearDown()
    {
        $this->agent = null;
    }

    public function testGetUserAgentStringMethod()
    {
        $this->assertEquals('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', $this->agent->getUserAgentString());
    }

    public function testAgentMethod()
    {
        $this->assertInstanceOf('\Jenssegers\Agent\Agent', $this->agent->agent());
    }

    public function testGetDeviceTypeMethod()
    {
        $this->assertEquals('desktop', $this->agent->getDeviceType());
    }

    public function testGetDeviceMethod()
    {
        $this->assertEquals('Macintosh', $this->agent->getDevice());
    }

    public function testGetOperatingSystemMethod()
    {
        $this->assertEquals('OS X', $this->agent->getOperatingSystem());
    }

    public function testGetBrowserMethod()
    {
        $this->assertEquals('Chrome', $this->agent->getBrowser());
    }
}
