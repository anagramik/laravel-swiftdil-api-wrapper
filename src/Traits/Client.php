<?php

namespace DogeDev\SwiftDil\Traits;


trait Client
{
    /**
     * Get a new instance of the Client model
     *
     * @return Client
     */
    private function getClient()
    {
        return new \GuzzleHttp\Client([
            'base_uri' => $this->url,
            'timeout'  => 2.0,
        ]);
    }
}