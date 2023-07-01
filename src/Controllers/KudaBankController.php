<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Giftbalogun\Kudaapitoken\Kuda;

/**
 * KudaOpenApi laravel package
 * @author Gift Balogun - amdeone <balogunigift@gmail.com>
 * @version 1
 **/

class KudaBankController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    // Kuda API NAME NAME_ENQUIRY
    //https://kudabank.gitbook.io/kudabank/single-fund-transfer/name-enquiry
    public function name_enquiry($payload, $requestRef = null)
    {
        return $this->kuda->makeRequest(
            ServiceTypes::NAME_ENQUIRY,
            $payload,
            $requestRef
        );
    }

    // Kuda LIST OF NIGERIA BANKS supported by NIBSS
    //https://kudabank.gitbook.io/kudabank/single-fund-transfer/bank-list
    public function getBankList($requestRef = null)
    {
        return $this->kuda->makeRequest(
            ServiceTypes::BANK_LIST,
            [],
            $requestRef
        );
    }

    // Kuda LIST OF CREATE VIRTUAL ACCOUNT FOR CUSTOMER
    //https://kudabank.gitbook.io/kudabank/virtual-account-creation#create-a-virtual-account
    public function create_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_CREATE_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function update_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_UPDATE_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function disable_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_DISABLE_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function enable_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_ENABLE_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda GET BUSINESS ACCOUNT BUSINESS
    //https://kudabank.gitbook.io/kudabank/check-admin-account-balance
    public function getadminbalance(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_RETRIEVE_MAIN_ACCOUNT_BALANCE;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    // Kuda GET VIRTUAL ACCOUNT DETAILS
    //https://kudabank.gitbook.io/kudabank/virtual-account-creation/retrieve-virtual-account
    public function retrieve_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::RETRIEVE_SINGLE_VIRTUAL_ACCOUNT;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function retrieve_all_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_VIRTUAL_ACCOUNTS;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
    
    // Kuda GET VIRTUAL ACCOUNT BALANCE
    //https://kudabank.gitbook.io/kudabank/check-virtual-account-balance
    public function retrieve_virtual_account_balance(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::RETRIEVE_VIRTUAL_ACCOUNT_BALANCE;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Retrieve a list of all transactions for a business account(admin)
    //https://kudabank.gitbook.io/kudabank/view-transaction-history/kuda-account-transaction-history
    public function admin_main_account_transaction(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_MAIN_ACCOUNT_TRANSACTIONS;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Retrieve a list of all transactions for a specified virtual account
    //https://kudabank.gitbook.io/kudabank/view-transaction-history/virtual-accounttransactionhistory
    public function retrieve_virtual_account_transaction(
        array $data,
        $requestRef
    ) {
        $servicetype = ServiceTypes::ADMIN_VIRTUAL_ACCOUNT_TRANSACTIONS;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Withdrawing funds from a virtual account.
    //https://kudabank.gitbook.io/kudabank/add-remove-money-from-a-virtual-account#withdraw-from-virtual-account
    public function withdraw_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::WITHDRAW_VIRTUAL_ACCOUNT;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

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

    //Transfer from a Kuda Account to any bank account
    //https://kudabank.gitbook.io/kudabank/single-fund-transfer/send-money-from-a-kuda-account
    public function single_fund_transfer($payload, $requestRef = null)
    {
        return $this->kuda->makeRequest(
            ServiceTypes::SINGLE_FUND_TRANSFER,
            $payload,
            $requestRef
        );
    }

    //Transfer from a Kuda Virtual Account to any bank account
    //https://kudabank.gitbook.io/kudabank/single-fund-transfer/virtual-account-fund-transfer
    public function virtual_fund_transfer($payload, $requestRef = null)
    {
        return $this->kuda->makeRequest(
            ServiceTypes::VIRTUAL_ACCOUNT_FUND_TRANSFER,
            $payload,
            $requestRef
        );
    }

    //Deposit to a virtual account
    //https://kudabank.gitbook.io/kudabank/add-remove-money-from-a-virtual-account
    public function fund_virtual_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::FUND_VIRTUAL_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
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
