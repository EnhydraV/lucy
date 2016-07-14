<?php

namespace Lucy\Blocks;

use Lucy\Contracts\BlockInterface;
use Lucy\Traits\BlockHydratorTrait;

class Basic extends AbstractBlock
{
    protected $block = 'A';

    protected $day;

    protected $month;

    protected $year;

    protected $hour;

    protected $minutes;

    protected $seconds;

    protected $timezone;

    protected $id;

    protected $clientIp;

    protected $sourcePort;

    protected $serverIp;

    protected $serverPort;

    public function parse($string)
    {
        preg_match('/^\[(\d{1,2})\/(\w{3})\/(\d{4})\:(\d{2})\:(\d{2})\:(\d{2})\s(\-\-\d{4}|\+\d{4})\]\s([a-zA-Z0-9\-\@]{24})\s([12]?[0-9]{1,2}\.[12]?[0-9]{1,2}\.[12]?[0-9]{1,2}\.[12]?[0-9]{1,2})\s(\d{1,5})\s([12]?[0-9]{1,2}\.[12]?[0-9]{1,2}\.[12]?[0-9]{1,2}\.[12]?[0-9]{1,2})\s(\d{1,5})/i', $string, $matches);

        $this->hydrate([
            'day' => $matches[1],
            'month' => $this->convertMonthToNumeric($matches[2]),
            'year' => $matches[3],
            'hour' => $matches[4],
            'minutes' => $matches[5],
            'seconds' => $matches[6],
            'timezone' => $matches[7],
            'id' => $matches[8],
            'clientIp' => $matches[9],
            'sourcePort' => $matches[10],
            'serverIp' => $matches[11],
            'serverPort' => $matches[12],
        ]);

        return $this;
    }
}
