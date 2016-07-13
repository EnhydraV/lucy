<?php

namespace Lucy;

class Parser
{
    protected $source;

    protected $blocks = [
        'A' => Blocks\Basic::class
    ];

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function getRawSource()
    {
        return $this->source;
    }

    public function parse()
    {
        
    }
}
