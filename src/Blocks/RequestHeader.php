<?php

namespace Lucy\Blocks;

use Lucy\Reader\UserAgent;

class RequestHeader extends AbstractBlock
{
    protected $block = 'B';

    protected $method;

    protected $path;

    protected $protocol;

    protected $host;

    protected $contentType;

    protected $referer;

    protected $userAgent;

    protected $cookie;

    public function parse($string)
    {
        $methods = ['method', 'host', 'contentType', 'referer', 'userAgent', 'cookie'];
        foreach ($methods as $method) {
            call_user_func_array([$this, 'extract'.ucwords($method)], [$string]);
        }

        return $this;
    }

    protected function extractMethod($string)
    {
        preg_match('/^(GET|POST|HEAD|PUT|DELETE|TRACE|PROPFIND|OPTIONS|CONNECT|PATCH)\s(.+)\s(HTTP\/[012]\.[019])/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'method' => $matches[1],
                'path' => $matches[2],
                'protocol' => $matches[3]
            ]);
        }
    }

    protected function extractHost($string)
    {
        preg_match('/^Host:\s(.+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'host' => $matches[1]
            ]);
        }
    }

    protected function extractContentType($string)
    {
        preg_match('/^Content-Type:\s([\w\-\/]+)\;\s([\w\-\;\.\/\*\+\=\:\?\,\s\(\)]+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'contentType' => $matches[1]
            ]);
        }
    }

    protected function extractReferer($string)
    {
        preg_match('/^Referer:\s(.+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'referer' => $matches[1]
            ]);
        }
    }

    protected function extractUserAgent($string)
    {
        preg_match('/^User-Agent:\s(.+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'userAgent' => new UserAgent($matches[1])
            ]);
        }
    }

    protected function extractCookie($string)
    {
        preg_match('/^Cookie:\s(.+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'cookie' => $matches[1]
            ]);
        }
    }
}
