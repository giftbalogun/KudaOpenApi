<?php

namespace Giftbalogun\Kudaapitoken;

use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class Kuda
{
    public string $env;
    public string $apitoken;
    public string $email;
    public string $baseUri;

    public function __construct()
    {
        //SET WORKING ENVIRONMENT
        $this->env = env('ENVIRONMENT_ENV');

        // Kuda API TOKEN FROM DEVELOPER ACCOUNT
        $this->apitoken = env('KUDA_API_TOKEN');

        // Kuda USER EMAIL FOR DEVELOPER ACCOUNT
        $this->email = env('KUDA_USER_EMAIL');

        // SET ENVIRONMENT REQUEST ENDPOINT
        $this->baseUri = Str::of($this->env)->lower()->is('live') ? 'https://kuda-openapi.kuda.com/v2.1' : 'http://kuda-openapi-uat.kudabank.com/v2.1';
    }

    // GET BEARER TOKEN HERE FOR EVERY REQUEST
    public function getToken()
    {
        $url = $this->baseUri . '/Account/GetToken';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->post($url, [
                        'email' => $this->email,
                        'apikey' => $this->apitoken,
                    ]);

            // Check the HTTP status code
            $statusCode = $response->status();

            if ($statusCode >= 200 && $statusCode < 300) {
                // Successful response (2xx)
                return $response->json();
            } elseif ($statusCode == 400) {
                // Bad Request (400)
                return [
                    'error' => 'Bad Request',
                    'message' => $response->json('message', 'Unknown error'),
                ];
            } elseif ($statusCode == 401) {
                // Unauthorized (401)
                return [
                    'error' => 'Unauthorized',
                    'message' => $response->json('message', 'Unknown error'),
                ];
            } elseif ($statusCode == 403) {
                // Forbidden (403)
                return [
                    'error' => 'Forbidden',
                    'message' => $response->json('message', 'Unknown error'),
                ];
            } elseif ($statusCode == 404) {
                // Not Found (404)
                return [
                    'error' => 'Not Found',
                    'message' => $response->json('message', 'Unknown error'),
                ];
            } elseif ($statusCode >= 500) {
                // Server Error (5xx)
                return [
                    'error' => 'Server Error',
                    'message' => $response->json('message', 'Unknown error'),
                ];
            } else {
                // Handle other status codes as needed
                return [
                    'error' => 'Unexpected Status Code: ' . $statusCode,
                    'message' => $response->json('message', 'Unknown error'),
                ];
            }
        } catch (\Throwable $th) {
            // Handle other exceptions
            return [
                'error' => 'Exception',
                'message' => $th->getMessage(),
            ];
        }
    }


    // Kuda PASS BEARER TOKEN TO REQUEST
    public function makeRequest(
        string $action,
        array $payload,
        $requestRef = null
    ) {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->baseUri, [
                        'servicetype' => $action,
                        'requestref' => (string) ($requestRef ?? bin2hex(random_bytes(10))),
                        'Data' => $payload,
                    ]);

            $statusCode = $response->status();

            if ($statusCode >= 200 && $statusCode < 300) {
                // Successful response (2xx)
                return $response;
                // return response()->json($response);
            } elseif ($statusCode == 400) {
                // Bad Request (400)
                return [
                    'Status' => false,
                    'Message' => 'Bad Request',
                    'Request' => 'Unable to Make Request',
                ];
            } elseif ($statusCode == 401) {
                // Unauthorized (401)
                return [
                    'Status' => false,
                    'Message' => 'Unauthorized',
                    'Request' => 'Unable to Make Request',
                ];
            } elseif ($statusCode == 403) {
                // Forbidden (403)
                return [
                    'Status' => false,
                    'Message' => 'Forbidden',
                    'Request' => 'Unable to Make Request',
                ];
            } elseif ($statusCode == 404) {
                // Not Found (404)
                return [
                    'Status' => false,
                    'Message' => 'Not Found',
                    'Request' => 'Unable to Make Request',
                ];
            } elseif ($statusCode == 409) {
                // Conflict (409)
                return [
                    'Status' => false,
                    'Message' => 'Conflict',
                    'Request' => 'Unable to Make Request',
                ];
            } elseif ($statusCode >= 500) {
                // Server Error (5xx)
                return [
                    'Status' => false,
                    'Message' => 'Server Error',
                    'Request' => 'Unable to Make Request',
                ];
            } else {
                // Handle other status codes as needed
                return [
                    'Status' => false,
                    'Message' => 'Unexpected Status Code: ' . $statusCode,
                    'Request' => 'Unable to Make Request',
                ];
            }
        } catch (\Throwable $th) {
            // Handle other exceptions
            return [
                'Status' => false,
                'Message' => $th->getMessage(),
                'Request' => 'Unable to Make Request',
            ];
        }
    }


    public function initController($controller)
    {
        $controller = Str::of($controller)->lower()->is('default') ? 'KudaBank' : $controller;
        $classname = 'Giftbalogun\\Kudaapitoken\\Controllers\\' . $controller . 'Controller';

        if (class_exists($classname) && get_parent_class($classname) === Controller::class) {
            return app($classname);
        }

        throw new \Exception("Invalid Controller");
    }
}
