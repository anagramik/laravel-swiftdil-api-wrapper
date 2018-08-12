<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class RiskProfile
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
     *  Retrieves the risk profile of an existing customer.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function getCustomerRiskProfile($clientId)
    {
        try {
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$clientId/risk_profile", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}