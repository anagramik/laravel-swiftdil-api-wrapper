<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Match
{
    protected $client;
    protected $token;

    public function __construct($token)
    {
        $this->token  = $token;
        $this->token  = $token;
        $this->client = new Client([
            'base_uri' => env('SWIFTDIL_URL'),
            'timeout'  => 2.0,
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
        try {
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId/matches/$matchId", [
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
        try {
            $response = $this->client->request('GET', "/customers/$customerId/screenings/$screeningId/matches", [
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
        try {
            $response = $this->client->request('POST', "/customers/$customerId/screenings/$screeningId/matches/$matchId/confirm", [
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
     * Dismisses a customer match.
     * You need to supply the unique customer, screening and match identifiers.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchIds
     *
     * @return mixed
     */
    public function confirmMultipleMatches($customerId, $screeningId, $matchIds)
    {
        try {
            $response = $this->client->request('POST', "/customers/$customerId/screenings/$screeningId/matches/confirm", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json' => $matchIds
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
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
    public function dismissAMatch($customerId, $screeningId, $matchId)
    {
        try {
            $response = $this->client->request('POST', "/customers/$customerId/screenings/$screeningId/matches/$matchId/dismiss", [
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
     * Bulk dismisses multiple customer matches.
     * You need to supply the unique customer, screening and match identifiers.
     *
     * @param $customerId
     * @param $screeningId
     * @param $matchIds
     *
     * @return mixed
     */
    public function dismissMultipleAMatch($customerId, $screeningId, $matchIds)
    {
        try {
            $response = $this->client->request('POST', "/customers/$customerId/screenings/$screeningId/matches/dismiss", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json' => $matchIds
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}