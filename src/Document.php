<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Document
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
     * Lists all existing documents associated with a given customer.
     * The documents are returned sorted by creation date, with the most recent documents appearing first.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/documents");
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
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/documents/$documentId");
    }

    /**
     * Creates a new document object. Optionally, attachments can be uploaded
     * as part of the document creation. attachments must be uploaded as a
     * multi-part form and the file size must not exceed 5MB.
     *
     * @param $data
     * @param $customerId
     *
     * @return mixed
     */
    public function create($data, $customerId)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/documents", [
            'form_params' => [
                'front_side'           => $data['front_side'],
                'back_side'            => $data['back_side'],
                'type'                 => $data['type'],
                'document_name'        => $data['document_name'],
                'document_description' => $data['document_description'],
                'document_number'      => $data['document_number'],
                'issuing_country'      => $data['issuing_country'],
                'issue_date'           => $data['issue_date'],
                'expiry_date'          => $data['expiry_date'],
                'mrz_line1'            => $data['mrz_line1'],
                'mrz_line2'            => $data['mrz_line2'],
            ],
        ]);
    }

    /**
     * Download specific document from a Customer
     *
     * @param $customerId
     * @param $documentId
     *
     * @return mixed
     */
    public function download($customerId, $documentId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/documents/$documentId/download");
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
        return $this->client->request('PUT', env('SWIFTDIL_URL') . "/customers/$customerId/documents/$documentId", [
            'form_params' => [
                'front_side'           => $data['front_side'],
                'back_side'            => $data['back_side'],
                'type'                 => $data['type'],
                'document_name'        => $data['document_name'],
                'document_description' => $data['document_description'],
                'document_number'      => $data['document_number'],
                'issuing_country'      => $data['issuing_country'],
                'issue_date'           => $data['issue_date'],
                'expiry_date'          => $data['expiry_date'],
                'mrz_line1'            => $data['mrz_line1'],
                'mrz_line2'            => $data['mrz_line2'],
            ],
        ]);
    }
}