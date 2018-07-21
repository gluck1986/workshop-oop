<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 18:13
 */

namespace ConvertFeed\Services\Writer;


use ConvertFeed\Entity\Feed;

class ScreenWriter
{
    public function write(Feed $feed)
    {
        print_r($feed);
    }
}