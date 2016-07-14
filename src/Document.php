<?php

namespace Lucy;

class Document implements Contracts\DocumentInterface
{
    protected $parser;

    protected $source;

    protected $sourceFile;

    public function __construct($sourceFile, Contracts\ParserInterface $parser)
    {
        $this->sourceFile = $sourceFile;
        $this->parser = $parser;
    }

    public function read()
    {
        $this->source = new \SplFileObject($this->sourceFile);

        while($this->source->valid()) {
            $line = trim($this->source->fgets());

            if (strlen($line) < 1) {
                break;
            }

            $block = $this->checkBlock($line);

            if (! is_null($block)) {
                $this->assignParserBlock($block);
            } else {
                $this->parser()->setString($line)->parse();
            }
        }
    }

    public function parser()
    {
        return $this->parser;
    }

    protected function checkBlock($string)
    {
        preg_match('/(^\-\-[a-z0-9]+\-)(.*)(\-\-)/', $string, $matches);

        if (count($matches) > 0) {
            return $matches[2];
        }

        return;
    }

    protected function assignParserBlock($blockName)
    {
        $block = $this->parser()->getBlock();
        if (! $block instanceof \Lucy\Contracts\BlockInterface) {
            $this->parser()->setBlock($blockName);
        } else {
            if ($blockName != $block->getBlockId()) {
                $this->parser()->setBlock($blockName);
            }
        }
    }
}
