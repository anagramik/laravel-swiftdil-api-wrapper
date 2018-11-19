<?php

namespace DogeDev\SwiftDil;


use DogeDev\SwiftDil\Traits\Client;

class DocumentVerification
{
    use Client;

    protected $token;
    protected $url;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
    }

    /**
     * Creates a new document verification object.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/verifications", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Retrieves the details of an existing document verification.
     * You need to supply the unique customer and document verification identifier.
     *
     * @param $customerId
     * @param $verificationId
     *
     * @return mixed
     */
    public function get($customerId, $verificationId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/verifications/$verificationId", [
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
     * Lists all existing document verifications for a given customer.
     * The verifications are returned sorted by creation date, with the most recent verifications appearing first.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$customerId/verifications" . [
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