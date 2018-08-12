<?php

namespace DogeDev\SwiftDil;

use GuzzleHttp\Client;

class Authenticate
{
    /** @var \GuzzleHttp\Client  */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'auth' => [
                env('SWIFTDIL_CLIENT_ID'), env('SWIFTDIL_CLIENT_SECRET')
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
    }

    public function getToken()
    {
        if (\Cache::has('access_token')) {
            return $this->refreshToken();
        }

        try {

            $response = $this->client->request('POST', env('SWIFTDIL_URL') . '/oauth2/token');
            $response = json_decode($response->getBody()->getContents());

            $accessTokenExpiresAt = now()->addSeconds($response->expires_in);
            $refreshTokenExpiresAt = now()->addSeconds($response->refresh_expires_in);

            \Cache::put('access_token', $response->access_token, $accessTokenExpiresAt);
            \Cache::put('refresh_token', $response->refresh_token, $refreshTokenExpiresAt);

        } catch (\Exception $e) {

            $code = $e->getCode();

            $message = $this->loadMessageFromException($e);

            // Unauthorized	Invalid authorisation credentials.
            if ($code == 401 && \Cache::get('refresh_token')) {

                return ($this->refreshToken()) {
                    return $this->getToken();
                }
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
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' =>  \Cache::get('refresh_token'),
                ],
            ];

            $response = $this->client->request('POST', env('SWIFTDIL_URL') . '/oauth2/token', $args);

        } catch (\Exception $e) {

            \Cache::forget('refresh_token');
            \Cache::forget('access_token');

            return false;
        }

        $response = json_decode($response->getBody()->getContents());

        $accessTokenExpiresAt = now()->addSeconds($response->expires_in);
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
}
