<?php

namespace Lucy\Contracts;

interface ParserInterface
{
    public function setBlock($block);

    public function getBlock();

    public function setString($string);

    public function getString();

    public function getContents();

    public function getBlockContent($block = null);
}
