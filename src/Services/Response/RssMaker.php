<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:05
 */

namespace ConvertFeed\Services\Response;


use ConvertFeed\Entity\Feed;

class RssMaker
{
    public function make(Feed $feed): string
    {
        $simpleXml = new \SimpleXMLElement('<rss version="2.0"></rss>');
        $chanel = $simpleXml->addChild('chanel');
        $chanel->addChild('title', $feed->title);

        return $simpleXml->asXML();
    }
}