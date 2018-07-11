<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class RiskProfile
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
     *  Retrieves the risk profile of an existing customer.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function getCustomerRiskProfile($clientId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$clientId/risk_profile");
    }
}