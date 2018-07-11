<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class IdentityVerification
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
     * Creates a new identity verification object.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/identifications", [
            'form_params' => [
                'document_id' => $data['document_id'],
                'selfie'      => $data['image'],
            ],
        ]);
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/identifications/$identificationId");
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/identifications");
    }
}
