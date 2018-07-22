<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 022 22.07.18
 * Time: 9:31
 */

namespace ConvertFeed\Tests;

use ConvertFeed\MainConverter;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    private function getAtomXml()
    {
        return '<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom">'
            . '<title>RSS Title</title><entry><title>Example entry</title>'
            . '<content>Here is some text containing an interesting description.</content>'
            . '<link>http://www.example.com/blog/post/1</link>'
            . '<updated>Sun, 06 Sep 2009 16:20:00 +0000</updated>'
            . '<id>7bd204c6-1655-4c27-aeee-53f933c5395f</id></entry>'
            . '<entry><title>Example entry1</title>'
            . '<content>Here is some text 1111111111 ription.</content>'
            . '<link>http://www.example.com/blog/post/2</link>'
            . '<updated>Sun, 06 Jun 2009 16:20:00 +0000</updated>'
            . '<id>7bd204c6-1655-4c27-aeee-a3f933c5395f</id></entry>'
            .'</feed>';
    }

    private function getRssXml()
    {
        return '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0"><channel>'
            . '<title>RSS Title</title><item><title>Example entry</title>'
            . '<description>Here is some text containing an interesting description.</description>'
            . '<link>http://www.example.com/blog/post/1</link>'
            . '<pubDate>Sun, 06 Sep 2009 16:20:00 +0000</pubDate>'
            . '<guid>7bd204c6-1655-4c27-aeee-53f933c5395f</guid>'
            . '</item>'
            .'<item><title>Example entry1</title>'
            . '<description>Here is some text 1111111111 ription.</description>'
            . '<link>http://www.example.com/blog/post/2</link>'
            . '<pubDate>Sun, 06 Jun 2009 16:20:00 +0000</pubDate>'
            . '<guid>7bd204c6-1655-4c27-aeee-a3f933c5395f</guid>'
            . '</item>'
            .'</channel></rss>';
    }

    public function testConvertRssToAtom()
    {
        $convert = new MainConverter();

        $result = $convert->convert($this->getRssXml(), 'atom');

        $this->assertXmlStringEqualsXmlString($this->getAtomXml(), $result);
    }

    public function testConvertAtomToRss()
    {
        $convert = new MainConverter();

        $result = $convert->convert($this->getAtomXml(), 'rss');

        $this->assertXmlStringEqualsXmlString($this->getRssXml(), $result);
    }
}
