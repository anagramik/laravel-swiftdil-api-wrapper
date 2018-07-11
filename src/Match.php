<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Match
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
     * Retrieves the details of an existing match.
     * You need to supply the unique customer, screening and match identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchId
     *
     * @return mixed
     */
    public function get($customerId, $screeningId, $matchId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches/$matchId");
    }

    /**
     * Lists all existing matches. The matches are returned sorted by overall score,
     * with the highest scoring matches appearing first.
     *
     * @param $customerId
     * @param $screeningId
     *
     * @return mixed
     */
    public function getAll($customerId, $screeningId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches");
    }

    /**
     * Confirms a customer match.
     * You need to supply the unique customer, screening and match identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchId
     *
     * @return mixed
     */
    public function confirmAMatch($customerId, $screeningId, $matchId)
    {
        return $this->client->request('POST', "/customers/$customerId/screenings/$screeningId/matches/$matchId/confirm");
    }

    /**
     * Dismisses a customer match.
     * You need to supply the unique customer, screening and match identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchId
     *
     * @return mixed
     */
    public function confirmMultipleMatches($customerId, $screeningId, $matchId)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches/$matchId/confirm");
    }

    /**
     * Bulk confirms multiple customer matches.
     * You need to supply the unique customer, screening and match identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchIds
     *
     * @return mixed
     */
    public function dismissAMatch($customerId, $screeningId, $matchIds)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches/confirm",[
            'form_params' => [
                'match_ids' => $matchIds
            ]
        ]);
    }

    /**
     * Bulk dismisses multiple customer matches.
     * You need to supply the unique customer, screening and match identifier.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchIds
     *
     * @return mixed
     */
    public function dismissMultipleAMatch($customerId, $screeningId, $matchIds)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches/dismiss",[
            'form_params' => [
                'match_ids' => $matchIds
            ]
        ]);
    }
}