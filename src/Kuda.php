<?php

namespace Giftbalogun\Kudaapitoken;

use GuzzleHttp\Client;
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
        $this->baseUri = Str::of($this->env)->lower()->is('live') ? 'https://kuda-openapi.kuda.com/v2' : 'https://kuda-openapi-uat.kudabank.com/v2';
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
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        try {
            /**
             * @var Response $response
             */
            $response = $client->post('', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getToken(),
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'data' => json_encode([
                        'serviceType' => $action,
                        'requestRef' =>
                            $requestRef ?? bin2hex(random_bytes(10)),
                        'data' => $payload,
                    ]),
                ],
            ]);

            $content = $response->getBody()->getContents();
            return json_decode($content, true);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            return [
                'Status' => false,
                'Message' => json_decode(
                    $response->getBody()->getContents(),
                    true
                ),
            ];
        } catch (\Throwable $th) {
            return ['Status' => false, 'Message' => $th->getMessage()];
        }
    }
}
