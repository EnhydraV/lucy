## LUCY

Inspired from the movie ```Lucy``` where at the end she turned into a USB stick which is quite ridiculous.

A PHP based parser for ```modsecurity``` log file. This library is used as parser for ```mlogc``` API request.

#### Usage

```php
<?php

use Lucy\Parser;
use Lucy\Document;

$document = new Document('modsecurity.log', new Parser);
$document->read(); //Read the log file content and parse all blocks

var_dump($document->parser()->getContents()); //Return all parsed blocks

var_dump($document->parser()->getBlockContent('B')); //Return parsed content for block B only
```

#### TODO

* Add parsers for remaining blocks
* Add and improve unit test
