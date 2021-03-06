<?php

namespace DogeDev\SwiftDil;

use DogeDev\SwiftDil\Traits\Client;

class IdentityVerification
{
    use Client;

    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url  = $url;
        $this->token  = $token;
    }

    /**
     * Creates a new identity verification object.
     *
     * @param $customerId
     * @param $data
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/identifications", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => $data
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Retrieves the details of an existing identity verification.
     * You need to supply the unique customer and identity verification identifier.
     *
     * @param $customerId
     * @param $identificationId
     *
     * @return mixed
     */
    public function get($customerId, $identificationId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/identifications/$identificationId", [
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
     * Lists all existing identity verifications for a given customer.
     * The verifications are returned sorted by creation date, with the most recent verifications appearing first.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/identifications", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}
