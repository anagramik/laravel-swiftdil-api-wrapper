<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Association
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
        return $this->client->request('GET', "/customers/$customerId/screenings/$screeningId/matches/$matchId/associations/$associationId");
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
        return $this->client->request('GET', "/customers/$customerId/screenings/$screeningId//matches/$matchId/associations");
    }
}