<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 022 22.07.18
 * Time: 15:09
 */

namespace ConvertFeed\Services\Parser;

use ConvertFeed\Entity\Feed;

interface Parser
{
    public function parse(\SimpleXMLElement $element): Feed;
}
