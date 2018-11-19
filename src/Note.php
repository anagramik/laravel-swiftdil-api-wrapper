<?php

namespace DogeDev\SwiftDil;

use DogeDev\SwiftDil\Traits\Client;

class Note
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
     * Creates a new note object.
     *
     * @param $customerId
     * @param $data
     *
     * @return mixed
     */
    public function create($customerId, $data)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/notes", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => [
                    'text' => $data,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
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
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/notes/$noteId", [
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
     * Lists all existing notes associated with a given customer.
     * The notes are returned sorted by creation date, with the most recent notes appearing first.
     **
     *
     * @param $customerId
     *
     * @note optinal params ?page=0&size=2&sort=column_name,DESC
     *
     * @return mixed
     */
    public function getAll($customerId)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . "/customers/$customerId/notes", [
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
     * Updates the details of an existing note.
     * You need to supply the unique customer and note identifier.
     *
     * @param $customerId
     * @param $noteId
     * @param $data
     *
     * @return mixed
     */
    public function update($customerId, $noteId, $data)
    {
        try {
            $response = $this->getClient()->request('PUT', $this->url . "/customers/$customerId/notes/$noteId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => [
                    'text' => $data,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
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
        try {
            $response = $this->getClient()->request('DELETE', $this->url . "/customers/$customerId/notes/$noteId", [
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
