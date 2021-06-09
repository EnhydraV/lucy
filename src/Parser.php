<?php

namespace Lucy;

use Carbon\Carbon;

class Parser implements Contracts\ParserInterface
{
    protected $string;

    protected $block;

    protected $blocks = [
        'A' => Blocks\Basic::class,
        'B' => Blocks\RequestHeader::class,
        'C' => Blocks\RequestBody::class,
        'E' => Blocks\ResponseBody::class,
        'F' => Blocks\ResponseHeader::class,
        'H' => Blocks\Debuginfo::class,
    ];

    protected $parsed = [];

    public function setBlock($block)
    {
        $blockClass = $this->blocks[$block];
        $this->block = new $blockClass;

        return $this;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function setString($string)
    {
        $this->string = $string;

        return $this;
    }

    public function getString()
    {
        return $this->string;
    }

    public function getContents()
    {
        return $this->parsed;
    }

    public function getBlockContent($block = null)
    {
        if (!is_null($block)) {
            return $this->getContents()[$block] ?? null;
        }

        return $this->getContents()[$this->getBlock()->getBlockId()] ?? null;
    }

    public function getMethod()
    {
        return mb_strtoupper($this->getProperty('B', 'method', ''));
    }

    public function getPath()
    {
        return $this->getProperty('B', 'path');
    }

    public function getProtocol()
    {
        return $this->getProperty('B', 'protocol');
    }

    public function getPostData(){
        parse_str($this->getProperty('C','content'),$res);
        return $res;
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        return Carbon::create(
            $this->getProperty('A', 'year'),
            $this->getProperty('A', 'month'),
            $this->getProperty('A', 'day'),
            $this->getProperty('A', 'hour'),
            $this->getProperty('A', 'minutes'),
            $this->getProperty('A', 'seconds'),
            $this->getProperty('A', 'timezone')
        );
    }

    public function getProperty($block, $property, $default = null)
    {
        $block = $this->getBlockContent($block);
        if (null === $block) {
            return $default;
        }
        return $block->{$property} ?? $default;
    }

    public function __call($method, $args)
    {
        if ($method === 'parse') {
            $parsed = call_user_func([$this->getBlock(), 'parse'], $this->getString());

            $this->parsed[$parsed->getBlockId()] = $parsed;
        }

        return $this;
    }
}
