<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 14:23
 */

namespace ConvertFeed\Services\Parser;

use ConvertFeed\Entity\Feed;

class ParsingProcessor
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $xml
     * @return Feed
     * @throws \Exception
     */
    public function parse(string $xml): Feed
    {
        $element = new \SimpleXMLElement($xml);

        return $this->parser->parse($element);
    }
}
