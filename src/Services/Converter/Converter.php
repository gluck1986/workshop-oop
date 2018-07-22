<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:17
 */

namespace ConvertFeed\Services\Converter;

use ConvertFeed\Services\Parser\ParsingProcessorFactory;
use ConvertFeed\Services\XmlSerialize\AtomSerializer;
use ConvertFeed\Services\XmlSerialize\RssSerializer;
use ConvertFeed\Services\XmlSerialize\XmlSerializer;

class Converter
{
    private $responseMaker;
    private $parsingProcessorFactory;
    private $atom;
    private $rss;

    public function __construct(
        XmlSerializer $responseMaker,
        ParsingProcessorFactory $parsingProcessorFactory,
        RssSerializer $rssMaker,
        AtomSerializer $atomMaker
    ) {
        $this->responseMaker = $responseMaker;
        $this->parsingProcessorFactory = $parsingProcessorFactory;
        $this->atom = $atomMaker;
        $this->rss = $rssMaker;
    }

    /**
     * @param string $xml
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function convert(string $xml, string $format): string
    {
        $parsingProcessor = $this->parsingProcessorFactory->factory($xml);
        $feed = $parsingProcessor->parse($xml);

        return $this->responseMaker->make($this->{$format}, $feed);
    }
}
