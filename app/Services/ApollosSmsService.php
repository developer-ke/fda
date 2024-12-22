<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApollosSmsService
{
    protected $client;
    protected $apiKey;
    protected $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.apollos_sms.api_key');
        $this->url = 'http://apollos.satesoft.com/api/v1/sms/json';
    }

    public function sendSms(array $messages)
    {
        try {
            $response = $this->client->post($this->url, [
                'headers' => [
                    'accept' => '*/*',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'apiKey' => $this->apiKey,
                    'messages' => $messages,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}