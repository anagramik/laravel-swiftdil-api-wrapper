<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Note
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
     * Creates a new note object.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function create($customerId, $text)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/notes", [
            'form_params' => [
                'text' => $text,
            ],
        ]);
    }

    /**
     * Retrieves the details of an existing note.
     * You need to supply the unique customer and note identifier.
     *
     * @param $customerId
     * @param $noteId
     *
     * @return mixed
     */
    public function get($customerId, $noteId)
    {
        return $this->client->request('POST', env('SWIFTDIL_URL') . "/customers/$customerId/notes/$noteId");
    }

    /**
     * Lists all existing notes associated with a given customer.
     * The notes are returned sorted by creation date, with the most recent notes appearing first.
     *
     * @param $customerId
     *
     * @return mixed
     */
    public function getAll($customerId, $noteId)
    {
        return $this->client->request('GET', env('SWIFTDIL_URL') . "/customers/$customerId/notes");
    }

    /**
     * Updates the details of an existing note.
     * You need to supply the unique customer and note identifier.
     *
     * @param $customerId
     * @param $noteId
     * @param $text
     *
     * @return mixed
     */
    public function update($customerId, $noteId, $text)
    {
        return $this->client->request('PUT', env('SWIFTDIL_URL') . "/customers/$customerId/notes/$noteId", [
            'form_paras' => [
                'text' => $text
            ]
        ]);
    }

    /**
     * Deletes an existing note.
     * You need to supply the unique customer and note identifier.
     *
     * @param $customerId
     * @param $noteId
     *
     * @return mixed
     */
    public function delete($customerId, $noteId)
    {
        return $this->client->request('DELETE', env('SWIFTDIL_URL') . "/customers/$customerId/notes/$noteId");
    }
}