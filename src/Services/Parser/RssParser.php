<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 14:55
 */

namespace ConvertFeed\Services\Parser;

use ConvertFeed\Entity\Feed;
use ConvertFeed\Entity\Item;

class RssParser implements Parser
{
    public function parse(\SimpleXMLElement $XMLElement): Feed
    {
        $feed = new Feed();
        $data = $XMLElement->channel;
        $feed->title = property_exists($data, 'title') ? $data->title->__toString() : '';
        $feed->subTitle = property_exists($data, 'description') ? $data->description->__toString() : '';
        if (property_exists($data, 'item')) {
            $feed->items = $this->makeItems($data->item ?? []);
        }
        return $feed;
    }

    private function makeItems($itemsData): array
    {
        $result = [];
        foreach ($itemsData as $itemData) {
            $item = new Item();
            $item->title = $itemData->title->__toString();
            $item->description = property_exists($itemData, 'description')
                ? $itemData->description->__toString() : null;
            $item->link = $itemData->link->__toString();
            $item->updated = property_exists($itemData, 'pubDate') ? $itemData->pubDate->__toString() : null;
            $item->id = property_exists($itemData, 'guid') ? $itemData->guid->__toString() : null;

            $result[] = $item;
        }
        return $result;
    }
}
