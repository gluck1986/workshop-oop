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

class AtomParser implements Parser
{
    public function parse(\SimpleXMLElement $data): Feed
    {
        $feed = new Feed();
        $feed->title = $data->title->__toString();
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
            $item->link = $itemData->link->__toString();
            $item->updated = $itemData->updated->__toString();
            $item->id = $itemData->id->__toString();
            $result[] = $item;
        }
        return $result;
    }
}
