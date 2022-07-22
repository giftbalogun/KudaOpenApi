<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\KudaApiToken;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Illuminate\Support\Facades\Http;

class KudabankController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        // Kuda API TOKEN FROM DEVELOPER ACCOUNT
        $this->apitoken = env('KUDA_API_TOKEN');
        // Kuda URL TEST/LIVE FROM DEVELOPER ACCOUNT
        $this->baseUri = env('KUDA_API_URL');
        // Kuda USER EMAIL FOR DEVELOPER ACCOUNT
        $this->email = env('KUDA_USER_EMAIL');
    }

    // Kuda API NAME NAME_ENQUIRY
    public function getAccountInfo($payload, $requestRef = null)
    {
        return $this->makeRequest(
            ServiceTypes::NAME_ENQUIRY,
            $payload,
            $requestRef
        );
    }

    // Kuda LIST OF NIGERIA BANKS
    public function getBankList($requestRef = null)
    {
        return $this->makeRequest(ServiceTypes::BANK_LIST, [], $requestRef);
    }

    // Kuda LIST OF CREATE VIRTUAL ACCOUNT FOR CUSTOMER
    public function create_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_CREATE_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda GET BUSINESS ACCOUNT BUSINESS
    public function getadminbalance(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_RETRIEVE_MAIN_ACCOUNT_BALANCE;
        $payload = $data;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda GET VIRTUAL ACCOUNT DETAILS
    public function retrieve_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::RETRIEVE_SINGLE_VIRTUAL_ACCOUNT;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda GET VIRTUAL ACCOUNT BALANCE
    public function retrieve_virtual_account_balance(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::RETRIEVE_VIRTUAL_ACCOUNT_BALANCE;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function retrieve_virtual_account_transaction(
        array $data,
        $requestRef
    ) {
        $servicetype = ServiceTypes::ADMIN_VIRTUAL_ACCOUNT_TRANSACTIONS;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function withdraw_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::WITHDRAW_VIRTUAL_ACCOUNT;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda WEBHOOK FOR RECEVING EVENT (CREDIT OR DEBIT) FROM KUDA
    public function webhook(Request $request)
    {
        // Retrieve the request's body
        $input = @file_get_contents('php://input');

        $event = json_decode($input);

        echo response()->json([$event], 200);

        http_response_code(200);
    }

    public function kudaAccountTransfer($payload, $requestRef = null)
    {
        return $this->makeRequest(
            ServiceTypes::SINGLE_FUND_TRANSFER,
            $payload,
            $requestRef
        );
    }

    public function fundvirtualaccount(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::FUND_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->makeRequest($servicetype, $data, $requestRef);

        return $result['data'];
    }

    // GET BEARER TOKEN HERE FOR EVERY REQUEST
    public function kudagenerateaccesstoken()
    {
        $url = $this->baseUri . '/account/gettoken';

        $fields = [
            'email' => $this->email,
            'apikey' => $this->apitoken,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->post($url, $fields);

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
                'json' => [
                    'data' => json_encode([
                        'serviceType' => $action,
                        'requestRef' =>
                            $requestRef ?? bin2hex(random_bytes(10)),
                        'data' => $payload,
                    ]),
                ],
                'headers' => [
                    'Authorization' =>
                        'Bearer ' . $this->kudagenerateaccesstoken(),
                    'Accept' => 'application/json',
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

    // Kuda POSSIBLE ERRORS WHEN INTERACTING WITH KUDA API
    private function errors($status_code)
    {
        return [
            '400' => 'Exception occured',
            '401' => 'Authentication failure',
            '403' => 'Forbidden',
            '404' => 'Resource not found',
            '405' => 'Method Not Allowed',
            '409' => 'Conflict',
            '412' => 'Precondition Failed',
            '413' => 'Request Entity Too Large',
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '503' => 'Service Unavailable',
        ][$status_code];
    }
}
