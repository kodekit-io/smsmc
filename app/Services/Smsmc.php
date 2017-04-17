<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Smsmc
{
    protected $baseApiUrl;
    protected $key;
    protected $client;

    /**
     * Smsmc constructor.
     */
    public function __construct(Client $client)
    {
        $this->key = config('services.smsmc.key');
        $this->baseApiUrl = config('services.smsmc.api_base_url');
        $this->suffix = config('services.smsmc.suffix');
        $this->client = $client;
    }

    public function getAccessToken($username, $password)
    {
        $params = [
            'appkey' => $this->key,
            'username' => $username,
            'password' => $password
        ];

        return $this->post('auth/login', $params, false, true, false);
    }

    public function post($url, $params = [], $withToken = true, $withSuffix = true, $cached = false)
    {
        $apiUrl = $this->baseApiUrl . $url;

        if ($withSuffix) {
            $apiUrl .=  '/' . $this->suffix;
        }

        if ($withToken) {
            $params['auth_token'] = session('api_auth_token');
        }

        if ($cached) {
            // days * hours * minutes
            $minutes = 5 * 24 * 60;
            $flatUrl = str_replace('/', '_', $apiUrl);
            $flatUrl = str_replace('-', '_', $flatUrl);

            $parsedResponse = Cache::remember($flatUrl, $minutes, function () use ($apiUrl, $params) {
                try {
                    $response = $this->client->post($apiUrl, [
                        'form_params' => $params
                    ]);
                    $parsedResponse = $this->parseResponse($response);
                } catch (\Exception $e) {
                    $parsedResponse = $this->proceedException($e, $apiUrl);
                }

                return $parsedResponse;
            });
        } else {
            try {
                $response = $this->client->post($apiUrl, [
                    'form_params' => $params
                ]);
                $parsedResponse = $this->parseResponse($response);
            } catch (\Exception $e) {
                $parsedResponse = $this->proceedException($e, $apiUrl);
            }
        }

        if ($apiUrl == 'http://103.16.199.58:8821/api_3.02_sm/project/1/2/convoexcel/sinarmas'){
            Log::warning($apiUrl . '===> ' . \GuzzleHttp\json_encode($params));
//            . '===> ' . \GuzzleHttp\json_encode($parsedResponse));
        }

        return $parsedResponse;

    }

    private function parseResponse($response)
    {
        $body = $response->getBody();
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        if ($code == 200 && $reason == 'OK') {
            $result = \GuzzleHttp\json_decode($body);

            if (isset($result->status) && $result->status != 'OK') {
                return new SimpleAPIResponse($result->code, $result->msg);
            }

            return new SimpleAPIResponse($code, $result);
        } elseif ($code == 401) {
            \Auth::logout();
            session()->flush();
            return new SimpleAPIResponse(401, 'Unauthorized');
        } else {
            return new SimpleAPIResponse(400, 'Bad API Result.');
        }
    }

    private function proceedException($e, $apiUrl)
    {
        $message = 'Unknown Error';
        $code = '000';
        if ($e instanceof TransferException) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $message = $response->getReasonPhrase();
                $code = $response->getStatusCode();
            }
        }
        Log::alert('ERROR API ==> ' . $message . ' at ' . $apiUrl);

        return new SimpleAPIResponse($code, $message . ' at ' . $apiUrl . '.');
    }
}