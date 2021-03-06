<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Authenticate
{
    protected $url;
    protected $clientId;
    protected $clientSecret;

    public function __construct($clientId, $clientSecret, $url)
    {
        $this->url          = $url;
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getToken()
    {
        if (\Cache::has('access_token')) {
            return $this->refreshToken();
        }

        try {

            $response = $this->client->request('POST', $this->url . '/oauth2/token');
            $response = json_decode($response->getBody()->getContents());

            $accessTokenExpiresAt  = now()->addSeconds($response->expires_in);
            $refreshTokenExpiresAt = now()->addSeconds($response->refresh_expires_in);

            \Cache::put('access_token', $response->access_token, $accessTokenExpiresAt);
            \Cache::put('refresh_token', $response->refresh_token, $refreshTokenExpiresAt);

        } catch (RequestException $e) {

            $code = $e->getCode();

            $message = $this->loadMessageFromException($e);

            // Unauthorized	Invalid authorisation credentials.
            if ($code == 401 && \Cache::get('refresh_token')) {

                return $this->refreshToken();
            }

            if ($code == 404) {

                abort(404, 'Not Found - The endpoint requested does not exist');
            }

            if ($code == 500) {

                abort(500, 'Server Error - Something is wrong on our end');
            }

            if ($code == 503) {

                abort(500, 'Server Unavailable - Service is unavailable (perhaps due to a planned upgrade');
            }

            throw new \Exception($message);
        }

        return \Cache::get('access_token');
    }

    protected function refreshToken()
    {

        try {

            $args = [
                'headers'     => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => \Cache::get('refresh_token'),
                ],
            ];

            $response = $this->client->request('POST', $this->url . '/oauth2/token', $args);

        } catch (\Exception $e) {

            \Cache::forget('refresh_token');
            \Cache::forget('access_token');

            return false;
        }

        $response = json_decode($response->getBody()->getContents());

        $accessTokenExpiresAt  = now()->addSeconds($response->expires_in);
        $refreshTokenExpiresAt = now()->addSeconds($response->refresh_expires_in);

        \Cache::put('access_token', $response->access_token, $accessTokenExpiresAt);
        \Cache::put('refresh_token', $response->refresh_token, $refreshTokenExpiresAt);

        return \Cache::get('access_token');
    }

    private function loadMessageFromException($e)
    {
        $message = json_decode($e->getResponse()->getBody()->getContents());

        if (empty($message)) {

            $message = $e->getResponse()->getReasonPhrase();
        }

        return $message;
    }

    /**
     * Get a new instance of the Client model
     *
     * @return Client
     */
    private function getClient()
    {
        return new Client([
            'auth'    => [
                $this->clientId, $this->clientSecret,
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }
}
