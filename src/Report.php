<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Report
{
    protected $client;
    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout'  => 2.0,
        ]);
    }

    /**
     * Retrieves the details of an existing report.
     * You need to supply the unique report identifier.
     *
     * @param $reportId
     *
     * @return mixed
     */
    public function get($reportId)
    {
        try {
            $response = $this->client->request('GET', $this->url . "/reports/$reportId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Lists all existing reports.
     * The reports are returned sorted by creation date, with the most recent reports appearing first.
     *
     * @note optinal params ?page=0&size=2&sort=column_name,DESC
     *
     * @return mixed
     */
    public function getAll()
    {
        try {
            $response = $this->client->request('GET', $this->url . "/reports", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Downloads a report document.
     * You need to supply the unique report identifier and extension.
     *
     * @param $reportId
     * @param $extension
     *
     * @return mixed
     */
    public function download($reportId, $extension)
    {
        try {
            $response = $this->client->request('GET', $this->url . "/reports/$reportId/$extension/download", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}