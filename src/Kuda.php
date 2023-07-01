<?php

namespace Giftbalogun\Kudaapitoken;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;

class Kuda
{
    public String $env;
    public String $apitoken;
    public String $email;
    public String $baseUri;

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

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->post($url, [
            'email' => $this->email,
            'apikey' => $this->apitoken,
        ]);

        return $response;
    }

    // Kuda PASS BEARER TOKEN TO REQUEST
    public function makeRequest(
        string $action,
        array $payload,
        $requestRef = null
    ) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json',
        ])->post($this->baseUri, [
            'servicetype' => $action,
            'requestref' => (string) ($requestRef ?? bin2hex(random_bytes(10))),
            'Data' => $payload,
        ]);
    
        try {
            return $response->json();
        } catch (\Throwable $th) {
            return [
                'Status' => false,
                'Message' => $th->getMessage(),
                'Request' => 'Unable to Make Request'
            ];
        }

    }
    
    public function initController($controller)
    {
        $controller = Str::of($controller)->lower()->is('default') ? 'KudaBank' : $controller;
        $classname = 'Giftbalogun\\Kudaapitoken\\Controllers\\' . $controller . 'Controller';

        if(class_exists($classname) && get_parent_class($classname) === \Illuminate\Routing\Controller::class) {
            return app($classname);
        }

        throw new \Exception("Invalid Controller");
    }
}
