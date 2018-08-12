<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Screening
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
     * Creates a new screening object.
     *
     * @param $customerId
     * @param $data
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        try {
            $response = $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/screenings", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Retrieves the details of an existing screening.
     * You need to supply the unique customer and screening identifier
     *
     * @param $customerId
     * @param screeningId
     *
     * @return mixed
     */
    public function get($customerId, $screeningId)
    {
        try {
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/$screeningId", [
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
     * Lists all existing screenings for a given customer.
     * The screenings are returned sorted by creation date, with the most recent screenings appearing first
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        try {
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings", [
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
     * Search for screenings across all existing customers.
     * The screenings are returned sorted by creation date, with the most recent screenings appearing first.
     *
     * @param $data
     *
     * @return mixed
     */
    public function search($data)
    {
        try {
            $response = $this->client->request('POST', env('SWIFTDIL_URL') . "/search/screenings", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json' => $data
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}