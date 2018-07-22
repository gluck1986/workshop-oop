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
    private $feedAtomFactory;

    public function __construct(FeedRssFactory $feedRssFactory, FeedAtomFactory $feedAtomFactory)
    {
        $this->feedRssFactory = $feedRssFactory;
        $this->feedAtomFactory = $feedAtomFactory;
    }

    /**
     * @param string $xml
     * @return Feed
     * @throws \Exception
     */
    public function make(string $xml): Feed
    {
        $element = new \SimpleXMLElement($xml);

        return $this->makeFeed($element);
    }

    /**
     * @param \SimpleXMLElement $simpleXMLElement
     * @return Feed
     * @throws \Exception
     */
    private function makeFeed(\SimpleXMLElement $simpleXMLElement): Feed
    {
        if (property_exists($simpleXMLElement, 'channel')) {
            return $this->feedRssFactory->make($simpleXMLElement->channel);
        } else {
            return $this->feedAtomFactory->make($simpleXMLElement);
        }

        throw new \Exception('unknown format');
    }


}