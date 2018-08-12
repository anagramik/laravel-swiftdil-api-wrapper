<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class DocumentVerification
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
     * Creates a new document verification object.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        try {
            $response = $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/verifications", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => [
                    'document_id' => $data['document_id'],
                    'type'        => $data['type'],
                ],
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
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/verifications/$verificationId", [
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
            $response = $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/verifications" . [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ]
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}