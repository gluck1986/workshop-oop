<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:05
 */

namespace ConvertFeed\Services\XmlSerialize;

use ConvertFeed\Entity\Feed;
use ConvertFeed\Entity\Item;

class AtomSerializer
{
    public function make(Feed $feed): string
    {
        $simpleXml = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom"></feed>'
        );

        $chanel = $simpleXml;
        if ($feed->title) {
            $chanel->addChild('title', $feed->title);
        }
        if ($feed->subTitle) {
            $chanel->addChild('subtitle', $feed->subTitle);
        }
        if ($feed->id) {
            $chanel->addChild('id', $feed->id);
        }
        foreach ($feed->items as $item) {
            /** @var Item $item */
            $xmlItem = $chanel->addChild('entry');
            if ($item->title) {
                $xmlItem->addChild('title', $item->title);
            }
            if ($item->content || $item->description) {
                $xmlItem->addChild('content', $item->content ?? $item->description);
            }
            if ($item->link) {
                $xmlItem->addChild('link', $item->link);
            }
            if ($item->updated) {
                $xmlItem->addChild('updated', $item->updated);
            }
            if ($item->id) {
                $xmlItem->addChild('id', $item->id);
            }
        }
        return $simpleXml->asXML();
    }
}
