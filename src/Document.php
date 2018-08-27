<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Document
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
     * Lists all existing documents associated with a given customer.
     * The documents are returned sorted by creation date, with the most recent documents appearing first.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        try {
            $response = $this->client->request('GET', $this->url . "/customers/$customerId/documents", [
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
     * Retrieves the details of an existing document.
     * You need to supply the unique customer and document identifier
     *
     * @param $customerId
     * @param $documentId
     *
     * @return mixed
     */
    public function get($customerId, $documentId)
    {
        try {
            $response = $this->client->request('GET', $this->url . "/customers/$customerId/documents/$documentId", [
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
     * Creates a new document object. Optionally, attachments can be uploaded
     * as part of the document creation. attachments must be uploaded as a
     * multi-part form and the file size must not exceed 5MB.
     *
     * @param $customerId
     * @param $data
     *
     * @return mixed
     */
    public function createAndUpload($customerId, $data)
    {
        return $this->client->request('POST', $this->url . "/customers/$customerId/documents", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type'  => 'application/json',
            ],
            'json'    => $data,
        ]);
    }

    /**
     * Download specific document from a Customer
     *
     * @param $customerId
     * @param $documentId
     * @param $side // front or back
     *
     * @return mixed
     */
    public function download($customerId, $documentId, $side = '')
    {
        try {
            $response = $this->client->request('GET', $this->url . "/customers/$customerId/documents/$documentId/download" . (($side !== '') ? '?side=' . $side : ''), [
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
     * Updates the details of an existing document. This is an idempotent method and will require all fields
     * you have on the document (including attachments if applicable) to be provided as part of request.
     * This will ensure document details held in your system are in line with the details held by SwiftDil.
     *
     * Please note, a document attachment will not be editable once it had undergone a image verification
     * check. Similarly, the MRZ lines will not be editable once an MRZ verification check had been made.
     *
     * @param $data
     * @param $customerId
     *
     * @return mixed
     */
    public function update($customerId, $documentId, $data)
    {
        try {
            $response = $this->client->request('PUT', $this->url . "/customers/$customerId/documents/$documentId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }
    }
}