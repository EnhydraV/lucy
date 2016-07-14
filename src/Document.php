<?php

namespace Lucy;

class Document
{
    protected $parser;

    protected $source;

    protected $sourceFile;

    public function __construct($sourceFile, $parser)
    {
        $this->sourceFile = $sourceFile;
        $this->parser = $parser;
    }

    public function read()
    {
        $this->source = new \SplFileObject($this->sourceFile);

        while($this->source->valid()) {
            $line = $this->source->fgets();

            if (strlen($line) < 1) {
                break;
            }

            if (! is_null($this->checkBlock($line))) {
                $this->parser = $this->parser->setBlock($this->checkBlock($line));
            } else {
                $this->parser->setString($line)->parse();
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
            if ($matches[2] == 'A') {
                return $matches[2];
            }

            return;
        }

        return;
    }
}
