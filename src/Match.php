<?php

namespace DogeDev\SwiftDil;

use DogeDev\SwiftDil\Traits\Client;

class Match
{
    use Client;

    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
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
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/screenings/$screeningId/matches/$matchId", [
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
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/screenings/$screeningId/matches", [
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
    public function confirm($customerId, $screeningId, $matchId)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/screenings/$screeningId/matches/$matchId/confirm", [
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
    public function confirmMultiple($customerId, $screeningId, $matchIds)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/screenings/$screeningId/matches/confirm", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => $matchIds,
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
    public function dismiss($customerId, $screeningId, $matchId)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/screenings/$screeningId/matches/$matchId/dismiss", [
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
    public function dismissMultiple($customerId, $screeningId, $matchIds)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/screenings/$screeningId/matches/dismiss", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => $matchIds,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}