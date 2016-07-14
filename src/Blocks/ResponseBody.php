<?php

namespace Lucy\Blocks;

class ResponseBody extends AbstractBlock
{
    protected $block = 'E';

    protected $content = '';

    public function parse($string)
    {
        $this->content .= "{$string}\n";

        return $this;
    }
}
