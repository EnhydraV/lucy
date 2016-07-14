<?php

namespace Lucy;

class Parser implements Contracts\ParserInterface
{
    protected $string;

    protected $block;

    protected $blocks = [
        'A' => Blocks\Basic::class,
        'B' => Blocks\RequestHeader::class,
        'F' => Blocks\ResponseHeader::class
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
        if (! is_null($block)) {
            return $this->getContents()[$block];
        }

        return $this->getContents()[$this->getBlock()->getBlockId()];
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
