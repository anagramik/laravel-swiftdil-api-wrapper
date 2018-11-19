<?php

namespace DogeDev\SwiftDil;


use DogeDev\SwiftDil\Traits\Client;

class File
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
     * Retrieves the details of an existing file.
     * You need to supply the unique file identifier.
     *
     * @param $fileId
     *
     * @return mixed
     */
    public function create($fileId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/files/$fileId", [
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
     * Lists all existing files associated with a given customer.
     * The files are returned sorted by creation date, with the most recent files appearing first.
     *
     * @return mixed
     */
    public function getAll()
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/files", [
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
     * Downloads a previously uploaded file.
     * You need to supply the unique file identifier and output format.
     *
     * @param $fileId
     * @param $type // STREAM or BASE64
     *
     * @return mixed
     */
    public function download($fileId, $type)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/files/$fileId?output=$type", [
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
     * Updates the details and content of an existing file. This is an idempotent method and will require all fields
     * you have on the file to be provided as part of request. This will ensure file details held in your system are in
     * line with the details held by SwiftDil.
     *
     * @param $fileId
     * @param $data
     *
     * @return mixed
     */
    public function update($fileId, $data)
    {
        try {
            $response = $this->getClient()->request('PUT', $this->url . "/files/$fileId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
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
        try {
            $response = $this->getClient()->request('DELETE', $this->url . "/files/$fileId", [
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