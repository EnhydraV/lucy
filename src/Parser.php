<?php

namespace Lucy;

class Parser
{
    protected $string;

    protected $block;

    protected $blocks = [
        'A' => Blocks\Basic::class,
        'B' => Blocks\Header::class
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

    public function getParsedContent($block = null)
    {
        if (! is_null($block)) {
            return $this->parsed[$block];
        }

        return $this->parsed[$this->getBlock()->getBlockId()];
    }

    public function __call($method, $args)
    {
        if ($method === 'parse') {
            $parsed = call_user_func([$this->getBlock(), 'parse'], $this->string);

            $this->parsed[$parsed->getBlockId()] = $parsed;
        }

        return $this;
    }
}
