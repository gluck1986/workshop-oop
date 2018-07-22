<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 022 22.07.18
 * Time: 18:53
 */

namespace ConvertFeed\Services\Parser;

class ParsingProcessorFactory
{
    public function factory($xml)
    {
        $head = substr($xml, 0, 100);

        if (preg_match_all('/feed/', $head)) {
            return new ParsingProcessor(new AtomParser());
        } else {
            return new ParsingProcessor(new RssParser());
        }
    }
}
