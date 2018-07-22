<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 19:03
 */

namespace ConvertFeed\Services\XmlSerialize;

use ConvertFeed\Entity\Feed;

class XmlSerializer
{
    public function make($maker, Feed $feed): string
    {
        return $maker->make($feed);
    }
}
