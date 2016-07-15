<?php

namespace Lucy\Reader\Geoip;

use GeoIp2\Database\Reader as GeoIpReader;

class Maxmind
{
    protected $ipAddress;

    protected $databases = [
        'city' => __DIR__.'/database/GeoLite2-City.mmdb',
        'country' => __DIR__.'/database/GeoLite2-Country.mmdb'
    ];

    protected $types = [];

    public function __construct($ipAddress)
    {
        $this->ipAddress  = $ipAddress;
        $this->loadDatabases();
    }

    public function city()
    {
        return $this->types['city']->city;
    }

    public function country()
    {
        return $this->types['country']->country;
    }

    protected function loadDatabases()
    {
        foreach ($this->databases as $type => $database) {
            $this->types[$type] = (new GeoIpReader($database))->{$type}($this->ipAddress);
        }
    }
}
