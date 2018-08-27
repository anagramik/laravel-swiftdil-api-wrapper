<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class RiskProfile
{
    protected $client;
    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
        $this->client = new Client([
            'base_uri' => $this->url,
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
            $response = $this->client->request('GET', $this->url . "/customers/$clientId/risk_profile", [
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