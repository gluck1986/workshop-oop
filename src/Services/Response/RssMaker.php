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

        $chanel = $simpleXml->addChild('channel');
        if ($feed->title) {
            $chanel->addChild('title', $feed->title);
        }
        foreach ($feed->items as $item) {
            /** @var Item $item */
            $xmlItem = $chanel->addChild('item');
            if ($item->title) {
                $xmlItem->addChild('title', $item->title);
            }
            if ($item->description) {
                $xmlItem->addChild('description', $item->description);
            }
            if ($item->content) {
                $xmlItem->addChild('description', $item->content);
            }
            if ($item->link) {
                $xmlItem->addChild('link', $item->link);
            }
            if ($item->updated) {
                $xmlItem->addChild('pubDate', $item->updated);
            }
            if ($item->id) {
                $xmlItem->addChild('guid', $item->id);
            }
        }

        return $simpleXml->asXML();
    }
}
