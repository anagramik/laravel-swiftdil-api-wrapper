<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Association
{
    protected $client;
    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
        $this->client = new Client([
            'base_uri' => $url,
            'timeout'  => 2.0,
        ]);
    }

    /**
     * Retrieves the details of an existing association.
     * You need to supply the unique customer, screening, match and association identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchId
     * @param $associationId
     *
     * @return mixed
     */
    public function get($customerId, $screeningId, $matchId, $associationId)
    {
        try {
            $response = $this->client->request('GET', "/customers/$customerId/screenings/$screeningId/matches/$matchId/associations/$associationId", [
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
     * Lists all existing associations.
     * The associations are returned sorted by creation date, with the most recent associations appearing first.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchId
     *
     * @return mixed
     */
    public function getAll($customerId, $screeningId, $matchId)
    {
        try {
            $response = $this->client->request('GET', "/customers/$customerId/screenings/$screeningId/matches/$matchId/associations", [
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