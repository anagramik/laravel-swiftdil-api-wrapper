<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class DocumentVerification
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
     * Creates a new document verification object.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/verifications", [
            'form_params' => [
                'document_id' => $data['document_id'],
                'type'        => $data['type'],
            ],
        ]);
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/verifications/$verificationId");
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/verifications");
    }
}