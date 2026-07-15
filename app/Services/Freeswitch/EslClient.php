<?php

namespace App\Services\Freeswitch;

use App\Services\FreeSwitchEsl;

class EslClient
{
    protected FreeSwitchEsl $client;

    public function __construct()
    {
        $this->client = new FreeSwitchEsl();
    }

    public function __call($method, $args)
    {
        return $this->client->$method(...$args);
    }
}
