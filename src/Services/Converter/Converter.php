<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:17
 */

namespace ConvertFeed\Services\Converter;

use ConvertFeed\Factories\FeedFactory;
use ConvertFeed\Services\Response\AtomMaker;
use ConvertFeed\Services\Response\ResponseMaker;
use ConvertFeed\Services\Response\RssMaker;

class Converter
{
    private $responseMaker;
    private $feedFactory;
    private $rss;
    private $atom;

    public function __construct(
        ResponseMaker $responseMaker,
        RssMaker $rssMaker,
        AtomMaker $atomMaker,
        FeedFactory $feedFactory
    ) {
        $this->responseMaker = $responseMaker;
        $this->rss = $rssMaker;
        $this->atom = $atomMaker;
        $this->feedFactory = $feedFactory;
    }

    /**
     * @param string $xml
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function convert(string $xml, string $format): string
    {
        $feed = $this->feedFactory->make($xml);

        return $this->responseMaker->make($this->{$format}, $feed);
    }
}
