<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 14:23
 */

namespace ConvertFeed\Factories;


use ConvertFeed\Entity\Feed;

class FeedFactory
{
    private $feedRssFactory;

    public function __construct(FeedRssFactory $feedRssFactory)
    {
        $this->feedRssFactory = $feedRssFactory;
    }

    public function make(string $xml): Feed
    {
        $element = new \SimpleXMLElement($xml);

        return $this->makeFeed($element);
    }

    private function makeFeed(\SimpleXMLElement $simpleXMLElement): Feed
    {
        try {
            return $this->feedRssFactory->make($simpleXMLElement->channel);
        } catch (\Exception $exception) {

        }
        throw new \Exception('unknown format');
    }


}