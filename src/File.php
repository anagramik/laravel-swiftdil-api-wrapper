<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class File
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
     * Retrieves the details of an existing file.
     * You need to supply the unique file identifier.
     *
     * @param $fileId
     *
     * @return mixed
     */
    public function create($fileId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/files/$fileId");
    }

    /**
     * Lists all existing files associated with a given customer.
     * The files are returned sorted by creation date, with the most recent files appearing first.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/files");
    }

    /**
     * Retrieves the details of an existing file.
     * You need to supply the unique file identifier.
     *
     * @param $fileId
     * @param $type // STREAM or BASE64
     *
     * @return mixed
     */
    public function download($fileId, $type)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/files/$fileId?output=$type");
    }

    /**
     * Deletes an existing file. You need only supply the unique file identifier.
     * Please note, once a file attachment has undergone any type of checks
     * (e.g. document verification, identity verification),
     * it can no longer be deleted.
     *
     * @param $fileId
     *
     * @return mixed
     */
    public function delete($fileId)
    {
        return $this->client->request('DELETE', env('SWIFTDIL_URL') . "/files/$fileId");
    }
}