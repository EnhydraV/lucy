<?php

namespace Lucy;

use Lucy\Contracts\ParserInterface;

class Document implements Contracts\DocumentInterface
{
    protected $parsers = [];

    protected $parserClass;

    protected $source;

    protected $sourceFile;


    public function __construct($sourceFile, $parserClass)
    {
        $this->sourceFile = $sourceFile;
        $this->parserClass = $parserClass;
        $this->read();
    }

    /**
     * @return ParserInterface[]
     */
    public function getParsers()
    {
        return $this->parsers;
    }

    public function read()
    {
        $this->source = new \SplFileObject($this->sourceFile);
        $newParser = true;

        while ($this->source->valid()) {
            if ($newParser) {
                $parser = new $this->parserClass();
                $this->parsers[] = $parser;
                $newParser = false;
            }
            $line = trim($this->source->fgets());

            if (strlen($line) < 1) {
                continue;
            }

            $block = $this->checkBlock($line);

            if ($block === 'Z') {
                $newParser=true;
                continue;
            }

            if (!is_null($block)) {
                $this->assignParserBlock($parser, $block);
            } else {
                $parser->setString($line)->parse();
            }
        }
    }

    protected function checkBlock($string)
    {
        preg_match('/(^\-\-[a-z0-9]+\-)(.*)(\-\-)/', $string, $matches);

        if (count($matches) > 0) {
            return $matches[2];
        }

        return null;
    }

    protected function assignParserBlock($parser, $blockName)
    {
        $block = $parser->getBlock();
        if (!$block instanceof \Lucy\Contracts\BlockInterface) {
            $parser->setBlock($blockName);
        } else {
            if ($blockName != $block->getBlockId()) {
                $parser->setBlock($blockName);
            }
        }
    }
}
