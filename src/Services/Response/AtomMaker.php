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

class AtomMaker
{
    public function make(Feed $feed): string
    {
        $simpleXml = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom"></feed>'
        );

        $chanel = $simpleXml;
        $chanel->addChild('title', $feed->title);
        $chanel->addChild('subtitle', $feed->subTitle);
        $chanel->addChild('id', $feed->id);
        foreach ($feed->items as $item) {
            /** @var Item $item */
            $xmlItem = $chanel->addChild('entry');
            $xmlItem->addChild('title', $item->title);
            $xmlItem->addChild('content', $item->content ?? $item->description);
            $xmlItem->addChild('link', $item->link);
            $xmlItem->addChild('updated', $item->updated);
            $xmlItem->addChild('id', $item->id);
        }

        return $simpleXml->asXML();
    }
}