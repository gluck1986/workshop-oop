<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 14:55
 */

namespace ConvertFeed\Factories;

use ConvertFeed\Entity\Feed;
use ConvertFeed\Entity\Item;

class FeedRssFactory
{
    public function make(\SimpleXMLElement $data): Feed
    {
        $feed = new Feed();

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
            $item->title = property_exists($itemData, 'title') ? $itemData->title->__toString() : null;
            $item->description = property_exists($itemData, 'description')
                ? $itemData->description->__toString() : null;
            $item->link = property_exists($itemData, 'link') ? $itemData->link->__toString() : null;
            $item->updated = property_exists($itemData, 'pubDate') ? $itemData->pubDate->__toString() : null;
            $item->id = property_exists($itemData, 'guid') ? $itemData->guid->__toString() : null;

            $result[] = $item;
        }
        return $result;
    }
}
