<?php

namespace Lucy\Blocks;

class ResponseHeader extends AbstractBlock
{
    protected $block = 'F';

    protected $protocol;

    protected $status;

    protected $message;

    protected $contentLength;

    protected $connection;

    protected $contentType;

    public function parse($string)
    {
        $methods = ['protocol', 'contentLength', 'connection', 'contentType'];
        foreach ($methods as $method) {
            call_user_func_array([$this, 'extract'.ucwords($method)], [$string]);
        }
        return $this;
    }

    protected function extractProtocol($string)
    {
        preg_match('/^(HTTP\/\d\.\d)\s(\d\d\d)\s([\w\s]+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'protocol' => $matches[1],
                'status' => $matches[2],
                'message' => $matches[3]
            ]);
        }
    }

    protected function extractContentLength($string)
    {
        preg_match('/^Content-Length:\s(\d+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'contentLength' => $matches[1]
            ]);
        }
    }

    protected function extractConnection($string)
    {
        preg_match('/^Connection:\s([\w-]+)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'connection' => $matches[1]
            ]);
        }
    }

    protected function extractContentType($string)
    {
        preg_match('/^Content-Type:\s((?:[\w\-\/]+)(?:\;)?(?:\s)?(?:[\w\-\;\.\/\*\+\=\:\?\,\s\(\)]+)?)/i', $string, $matches);

        if (count($matches) > 0) {
            $this->hydrate([
                'contentType' => $matches[1]
            ]);
        }
    }
}
