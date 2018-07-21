<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:17
 */

namespace ConvertFeed\Services\Converter;


use ConvertFeed\Factories\FeedFactory;
use ConvertFeed\Services\Response\ResponseMaker;
use ConvertFeed\Services\Response\RssMaker;

class Converter
{
    const FORMTAT_RSS = 'rss';

    private $responseMaker;
    private $feedFactory;
    private $rss;

    public function __construct(
        ResponseMaker $responseMaker,
        RssMaker $rssMaker,
        FeedFactory $feedFactory
    ) {
        $this->responseMaker = $responseMaker;
        $this->rss = $rssMaker;
        $this->feedFactory = $feedFactory;
    }

    public function convert(string $xml, string $format): string
    {
        $feed = $this->feedFactory->make($xml);

        return $this->responseMaker->make($this->{$format}, $feed);
    }
}