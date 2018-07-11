<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Screening
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
     * Creates a new screening object.
     *
     * @param $customerId
     * @param $data
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/screenings", [
            'form_params' => $data
        ]);
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings/screeningId");
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/screenings");
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
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/search/screenings", $data);
    }
}