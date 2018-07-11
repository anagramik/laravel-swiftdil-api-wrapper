<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Report
{
    protected $client;

    public function __construct($token)
    {
        $this->client = new Client([
            'base_uri' => env('SWIFTDIL_URL'),
            'timeout'  => 2.0,
            'headers'  => [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ],
        ]);
    }

    /**
     * Each report type is associated with its own set of parameters, passed in a key-value format:
     *
     * @param $reportId
     *
     * @return mixed
     */
    public function get($reportId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/reports/$reportId");
    }

    /**
     * Lists all existing reports.
     * The reports are returned sorted by creation date, with the most recent reports appearing first
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/reports");
    }

    /**
     * Each report type is associated with its own set of parameters, passed in a key-value format:
     *
     * @param $reportId
     * @param $extension
     *
     * @return mixed
     */
    public function download($reportId, $extension)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/reports/$reportId/$extension/download");
    }
}