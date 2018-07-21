<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 13:09
 */

namespace ConvertFeed\Services\Reader;


use GuzzleHttp\Client;

class ReaderService
{
    private $guzzleClient;

    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function process(string $path = ''): string
    {
        $request = $this->guzzleClient->get($path);

        return $request->getBody()->getContents();
    }
}