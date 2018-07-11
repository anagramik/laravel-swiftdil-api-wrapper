<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Customer
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
     * Lists all existing customers. The customers are returned sorted by
     * creation date, with the most recent customers appearing first.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers");
    }

    /**
     *  Retrieves the details of an existing customer.
     * You need only supply the unique customer identifier that was returned upon customer creation.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function get($clientId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$clientId");
    }

    /**
     *  Creates a new customer object.
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . '/customers', $data);
    }

    /**
     * Updates the details of an existing customer
     * Please note, the customer type will not be editable once set.
     * Additionally, certain fields will not be editable once the customer has undergone a check.
     *
     * @param $clientId
     * @param $data
     *
     * @return mixed
     */
    public function update($clientId, $data)
    {
        return $this->client->request('PUT', env('SWIFTDIL_URL') ."/customers/$clientId", $data);
    }

    /**
     * Deletes an existing customer. You need only supply the unique customer identifier that was returned upon
     * customer creation. Also deletes any documents and notes on the customer. Please note, once a customer
     * has undergone any type of checks (e.g. screening), they can no longer be deleted.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function delete($clientId)
    {
        return $this->client->request('DELETE', env('SWIFTDIL_URL') . "/customers/$clientId");
    }
}