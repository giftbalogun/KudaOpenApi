<?php

namespace Giftbalogun\Kudaapitoken;

use \Vurl\Vurl;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Kuda
{
    public string $env;
    public string $apitoken;
    public string $email;
    public string $baseUri;

    /*
    |--------------------------------------------------------------------------
    | contruct
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        // Kuda USER EMAIL FOR DEVELOPER ACCOUNT
        $this->email = config('kudaapitoken.api_email');
        
        // Kuda API TOKEN FROM DEVELOPER ACCOUNT
        $this->apitoken = config('kudaapitoken.api_token');

        //SET WORKING ENVIRONMENT
        $this->env = config('kudaapitoken.environment_type');

        // SET ENVIRONMENT REQUEST ENDPOINT
        $this->baseUri = Str::of($this->env)->lower()->is('live') ? 'https://kuda-openapi.kuda.com/v2.1/' : 'https://kuda-openapi-uat.kudabank.com/v2.1/';
    }

    /*
    |--------------------------------------------------------------------------
    | getToken to make request
    |--------------------------------------------------------------------------
    */
    public function getToken()
    {
        return Cache::remember('kuda_api_token', now()->addMinutes(30), function () {
            $url = $this->baseUri . 'Account/GetToken';

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Cache-Control' => 'no-cache',
                ])->post($url, [
                    'email' => $this->email,
                    'apikey' => $this->apitoken,
                ]);

                $statusCode = $response->status();

                if ($statusCode >= 200 && $statusCode < 300) {
                    \Log::info($response->body());
                    return $response->body();
                } 
                if ($statusCode == 400) {
                    return [
                        'error' => 'Bad Request',
                        'message' => $response->json('message', 'Unknown error'),
                    ];
                } 
                if ($statusCode == 401) {
                    return [
                        'error' => 'Unauthorized',
                        'message' => $response->json('message', 'Unknown error'),
                    ];
                } 
                if ($statusCode == 403) {
                    return [
                        'error' => 'Forbidden',
                        'message' => $response->json('message', 'Unknown error'),
                    ];
                } 
                if ($statusCode == 404) {
                    return [
                        'error' => 'Not Found',
                        'message' => $response->json('message', 'Unknown error'),
                    ];
                } 
                if ($statusCode >= 500) {
                    return [
                        'error' => 'Server Error',
                        'message' => $response->json('message', 'Unknown error'),
                    ];
                }
                
                return [
                    'error' => 'Unexpected Status Code: ' . $statusCode,
                    'message' => $response->json('message', 'Unknown error'),
                ];
                
            } catch (\Throwable $th) {
                // Handle other exceptions
                return [
                    'error' => 'Exception',
                    'message' => $th->getMessage(),
                ];
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | pass getToken to make request
    |--------------------------------------------------------------------------
    */
    public function makeRequest(
        string $action,
        array $payload,
        $requestRef = null
    ) {
        try {
            $token = $this->getToken();  
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->post($this->baseUri, [
                'servicetype' => $action,
                'requestref' => (string) ($requestRef ?? bin2hex(random_bytes(10))),
                'Data' => $payload,
            ]);
            $statusCode = $response->status();

            if ($statusCode >= 200 && $statusCode < 300) {
                return $response;
            } 
            if ($statusCode == 400) {
                return [
                    'Status_Code' => 400,
                    'Status' => false,
                    'Message' => 'Bad Request',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            if ($statusCode == 401) {
                return [
                    'Status_Code' => 401,
                    'Status' => false,
                    'Message' => 'Unauthorized',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            if ($statusCode == 403) {
                return [
                    'Status_Code' => 403,
                    'Status' => false,
                    'Message' => 'Forbidden',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            if ($statusCode == 404) {
                return [
                    'Status_Code' => 404,
                    'Status' => false,
                    'Message' => 'Not Found',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            if ($statusCode == 409) {
                return [
                    'Status_Code' => 409,
                    'Status' => false,
                    'Message' => 'Conflict',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            if ($statusCode >= 500) {
                return [
                    'Status_Code' => 500,
                    'Status' => false,
                    'Message' => 'Server Error',
                    'Request' => 'Unable to Make Request',
                ];
            } 
            return [
                'Status' => false,
                'Message' => 'Unexpected Status Code: ' . $statusCode,
                'Request' => 'Unable to Make Request',
            ];
        } catch (\Throwable $th) {
            return [
                'Status' => false,
                'Message' => $th->getMessage(),
                'Request' => 'Unable to Make Request',
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | call up controller
    |--------------------------------------------------------------------------
    */
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
