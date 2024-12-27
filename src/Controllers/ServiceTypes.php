<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

/**
 * KudaOpenApi laravel package
 * @author Gift Balogun - amdeone <balogunigift@gmail.com>
 * @version 1
 **/

/*
|--------------------------------------------------------------------------
| SERVICE TYPE ENUMS
|--------------------------------------------------------------------------
*/
class ServiceTypes
{
    /*
    |--------------------------------------------------------------------------
    | LIST OF API SERVICES OFFERED BY KUDA
    |--------------------------------------------------------------------------
    */
    const BANK_LIST = 'BANK_LIST';
    const NAME_ENQUIRY = 'NAME_ENQUIRY';
    const RETRIEVE_STATEMENT = 'RETRIEVE_STATEMENT';
    const SINGLE_FUND_TRANSFER = 'SINGLE_FUND_TRANSFER';
    const FUND_VIRTUAL_ACCOUNT = 'FUND_VIRTUAL_ACCOUNT';
    const ADMIN_VIRTUAL_ACCOUNTS = 'ADMIN_VIRTUAL_ACCOUNTS';
    const TRANSACTION_STATUS_QUERY = 'TRANSACTION_STATUS_QUERY';
    const WITHDRAW_VIRTUAL_ACCOUNT = 'WITHDRAW_VIRTUAL_ACCOUNT';
    const RETRIEVE_TRANSACTION_LOGS = 'RETRIEVE_TRANSACTION_LOGS';
    const ADMIN_CREATE_VIRTUAL_ACCOUNT = 'ADMIN_CREATE_VIRTUAL_ACCOUNT';
    const ADMIN_UPDATE_VIRTUAL_ACCOUNT = 'ADMIN_UPDATE_VIRTUAL_ACCOUNT';
    const ADMIN_DISABLE_VIRTUAL_ACCOUNT = 'ADMIN_DISABLE_VIRTUAL_ACCOUNT';
    const ADMIN_ENABLE_VIRTUAL_ACCOUNT = 'ADMIN_ENABLE_VIRTUAL_ACCOUNT';
    const VIRTUAL_ACCOUNT_FUND_TRANSFER = 'VIRTUAL_ACCOUNT_FUND_TRANSFER';
    const RETRIEVE_SINGLE_VIRTUAL_ACCOUNT = 'ADMIN_RETRIEVE_SINGLE_VIRTUAL_ACCOUNT';
    const ADMIN_MAIN_ACCOUNT_TRANSACTIONS = 'ADMIN_MAIN_ACCOUNT_TRANSACTIONS';
    const COLLECTION_ACCOUNT_FUND_TRANSFER = 'COLLECTION_ACCOUNT_FUND_TRANSFER';
    const RETRIEVE_VIRTUAL_ACCOUNT_BALANCE = 'RETRIEVE_VIRTUAL_ACCOUNT_BALANCE';
    const ADMIN_VIRTUAL_ACCOUNT_TRANSACTIONS = 'ADMIN_VIRTUAL_ACCOUNT_TRANSACTIONS';
    const ADMIN_RETRIEVE_MAIN_ACCOUNT_BALANCE = 'ADMIN_RETRIEVE_MAIN_ACCOUNT_BALANCE';
    const ADMIN_MAIN_ACCOUNT_FILTERED_TRANSACTIONS = 'ADMIN_MAIN_ACCOUNT_FILTERED_TRANSACTIONS';
    const ADMIN_VIRTUAL_ACCOUNT_FILTERED_TRANSACTIONS = 'ADMIN_VIRTUAL_ACCOUNT_FILTERED_TRANSACTIONS';

    /*
    |--------------------------------------------------------------------------
    | KUDA SAVING API
    |--------------------------------------------------------------------------
    */
    const GET_PLAIN_SAVINGS = 'GET_PLAIN_SAVINGS';
    const CREATE_PLAIN_SAVINGS = 'CREATE_PLAIN_SAVINGS';
    const UPDATE_PLAIN_SAVINGS = 'UPDATE_PLAIN_SAVINGS';
    const GET_ALL_PLAIN_SAVINGS = 'GET_ALL_PLAIN_SAVINGS';
    const CREATE_OPEN_FLEXIBLE_SAVE = 'CREATE_OPEN_FLEXIBLE_SAVE';
    const PLAIN_SAVINGS_TRANSACTIONS = 'PLAIN_SAVINGS_TRANSACTIONS';
    const CREATE_CLOSED_FLEXIBLE_SAVE = 'CREATE_CLOSED_FLEXIBLE_SAVE';
    const GET_ALL_CUSTOMER_PLAIN_SAVINGS = 'GET_ALL_CUSTOMER_PLAIN_SAVINGS';
    const RETRIEVE_PLAIN_SAVINGS_TRANSACTIONS = 'RETRIEVE_PLAIN_SAVINGS_TRANSACTIONS';
    const RETRIEVE_SPEND_AND_SAVE_TRANSACTIONS = 'RETRIEVE_SPEND_AND_SAVE_TRANSACTIONS';

    /*
    |--------------------------------------------------------------------------
    | KUDA BILL PAYMENT & BETTING SERVICE
    |--------------------------------------------------------------------------
    */
	const BILL_TSQ = 'BILL_TSQ';
	const PURCHASE_BILL= 'PURCHASE_BILL';
	const GET_BILLERS_BY_TYPE = 'GET_BILLERS_BY_TYPE';
	const ADMIN_PURCHASE_BILL = 'ADMIN_PURCHASE_BILL';
	const GET_PURCHASED_BILLS = 'GET_PURCHASED_BILLS';
	const VERIFY_BILL_CUSTOMER = 'VERIFY_BILL_CUSTOMER';
	const ADMIN_GET_PURCHASED_BILLS = 'ADMIN_GET_PURCHASED_BILLS';

    /*
    |--------------------------------------------------------------------------
    | KUDA GIFT CARDS
    |--------------------------------------------------------------------------
    */
    const BUY_GIFT_CARD = 'BUY_GIFT_CARD';
    const GET_GIFT_CARD = 'GET_GIFT_CARD';
    const GIFT_CARD_TSQ = 'GIFT_CARD_TSQ';
    const ADMIN_BUY_GIFT_CARD = 'ADMIN_BUY_GIFT_CARD';

    /*
    |--------------------------------------------------------------------------
    | KUDA CARD
    |--------------------------------------------------------------------------
    */
    const BLOCK_CARD = 'BLOCK_CARD';
    const REQUEST_CARD = 'REQUEST_CARD';
    const GET_CARD_PIN = 'GET_CARD_PIN';
    const UNBLOCK_CARD = 'UNBLOCK_CARD';
    const ACTIVATE_CARD = 'ACTIVATE_CARD';
    const DEACTIVATE_CARD = 'DEACTIVATE_CARD';
    const CHANGE_CARD_PIN = 'CHANGE_CARD_PIN';
    const GET_CUSTOMER_CARDS = 'GET_CUSTOMER_CARDS';
    const MANAGE_CARD_CHANNEL = 'MANAGE_CARD_CHANNEL';
    const MANAGE_CARD_TRANSACTION_LIMIT = 'MANAGE_CARD_TRANSACTION_LIMIT';

    /*
    |--------------------------------------------------------------------------
    | KUDA PAY WITH TRANSFER
    |--------------------------------------------------------------------------
    */
    const DYNAMIC_COLLECTION_ACCOUNT_TSQ = 'DYNAMIC_COLLECTION_ACCOUNT_TSQ';
    const ADMIN_CREATE_DYNAMIC_COLLECTION_ACCOUNT = 'ADMIN_CREATE_DYNAMIC_COLLECTION_ACCOUNT';
    // const GET_CARD_PIN = 'GET_CARD_PIN';
    // const UNBLOCK_CARD = 'UNBLOCK_CARD';
    // const ACTIVATE_CARD = 'ACTIVATE_CARD';
    // const DEACTIVATE_CARD = 'DEACTIVATE_CARD';
    // const CHANGE_CARD_PIN = 'CHANGE_CARD_PIN';
    // const GET_CUSTOMER_CARDS = 'GET_CUSTOMER_CARDS';
    // const MANAGE_CARD_CHANNEL = 'MANAGE_CARD_CHANNEL';
    // const MANAGE_CARD_TRANSACTION_LIMIT = 'MANAGE_CARD_TRANSACTION_LIMIT';

}
