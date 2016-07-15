<?php

namespace Lucy\Reader\Geoip;

class Reader extends AbstractReader
{
    protected $reader;

    public function __construct($ipAddress)
    {
        parent::__construct($ipAddress);

        $this->reader = new Maxmind($ipAddress);
    }

    public function getCountryCode()
    {
        return $this->reader->country()->isoCode;
    }

    public function getCountryName()
    {
        return $this->reader->country()->name;
    }
}
