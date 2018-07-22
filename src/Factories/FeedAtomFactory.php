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

class FeedAtomFactory
{
    public function make(\SimpleXMLElement $data): Feed
    {
        $feed = new Feed();
        $feed->title = property_exists($data, 'title') ? $data->title->__toString() : '';
        $feed->subTitle = property_exists($data, 'subtitle') ? $data->subtitle->__toString() : '';
        if (property_exists($data, 'entry')) {
            $feed->items = $this->makeItems($data->entry ?? []);
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
            $item->content = property_exists($itemData, 'content')
                ? $itemData->content->__toString() : null;
            $item->link = property_exists($itemData, 'link') ? $itemData->link->__toString() : null;
            $item->updated = property_exists($itemData, 'updated') ? $itemData->updated->__toString() : null;
            $item->id = property_exists($itemData, 'id') ? $itemData->id->__toString() : null;

            $result[] = $item;
        }
        return $result;
    }
}
