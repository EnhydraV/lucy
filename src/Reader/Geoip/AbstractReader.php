<?php

namespace Lucy\Reader\Geoip;

use Lucy\Contracts\GeoIpReaderInterface;

abstract class AbstractReader implements GeoIpReaderInterface
{
    protected $ipAddress;

    public function __construct($ip)
    {
        $this->ipAddress = $ip;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function getReader()
    {
        return $this->reader;
    }
}
