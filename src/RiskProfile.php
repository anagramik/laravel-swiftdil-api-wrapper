<?php

namespace DogeDev\SwiftDil;

use DogeDev\SwiftDil\Traits\Client;

class RiskProfile
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
     *  Retrieves the risk profile of an existing customer.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function getCustomerRiskProfile($clientId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$clientId/risk_profile", [
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