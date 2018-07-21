<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:05
 */

namespace ConvertFeed\Services\Response;


use ConvertFeed\Entity\Feed;
use ConvertFeed\Entity\Item;

class RssMaker
{
    public function make(Feed $feed): string
    {
        $simpleXml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0"></rss>');

        $chanel = $simpleXml->addChild('chanel');
        $chanel->addChild('title', $feed->title);
        foreach ($feed->items as $item) {
            /** @var Item $item */
            $xmlItem = $chanel->addChild('item');
            $xmlItem->addChild('title', $item->title);
            $xmlItem->addChild('description', $item->description);
            $xmlItem->addChild('link', $item->link);
            $xmlItem->addChild('pubDate', $item->updated);
            $xmlItem->addChild('guid', $item->id);
        }

        return $simpleXml->asXML();
    }
}