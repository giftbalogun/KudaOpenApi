# Availabile Commands to use under KudaApiToken

# Data Structure
```php

$data = [
    'email' => $request->email,
    'phoneNumber' => $request->phone,
    'lastName' => $request->l_name,
    'firstName' => $request->f_name,
    'businessName' => $request->business_name,
    'trackingReference' => $customer_code,
];

```

For Pay with Transfer
```php
$data = [
    "Amount"=>5000000,
    "IsFlexiblePayment"=>true, //true or false
    "RemittingAccounts"=>[
    {
        "SplitPercentage"=>50,
        "AccountName"=>"foods",
        "AccountNumber"=>"3020806687"
    },
    {
        "SplitPercentage"=>50,
        "AccountName"=>"foods",
        "AccountNumber"=>"3020808612"
    }
    ]
];

```

# Banking API
use Giftbalogun\Kudaapitoken\Controllers\KudaBankController;

- webhook
- getBankList
- name_enquiry
- getadminbalance
- retrieve_statement
- single_fund_transfer
- fund_virtual_account
- virtual_fund_transfer
- update_virtual_account
- create_virtual_account
- enable_virtual_account
- disable_virtual_account
- retrieve_virtual_account
- withdraw_virtual_account
- retrieve_all_virtual_account
- admin_main_account_transaction
- retrieve_virtual_account_balance
- collection_account_fund_transfer
- retrieve_virtual_account_transaction


# Bill/Utility API
use Giftbalogun\Kudaapitoken\Controllers\BillController;

- bill_tsq
- purchase_bill
- get_biller_type
- admin_purchase_bill
- get_purchased_bills
- verify_bill_customer
- admin_get_purchased_bills


# Savings API
use Giftbalogun\Kudaapitoken\Controllers\SavingController;

- get_saving_plan
- create_saving_plan
- update_plain_saving
- get_all_saving_plan
- get_open_flexible_save
- plain_saving_transaction
- get_closed_flexible_save
- create_open_flexible_save
- create_close_flexible_save
- get_spend_save_transactions
- get_all_customer_saving_plan
- retrieve_plain_savings_transactions


# GiftCard API
use Giftbalogun\Kudaapitoken\Controllers\GiftCardController;

- getgiftcard
- buygiftcard
- giftcard_tsq
- admin_buygiftcard


# KudaCard API
use Giftbalogun\Kudaapitoken\Controllers\CardController;

- blockcard
- getcardpin
- requestcard
- unblockcard
- activatecard
- changecardpin
- deactivatecard
- managecardlimit
- getcustomercard
- managecardchannel


# KudaCard API
use Giftbalogun\Kudaapitoken\Controllers\PayWithController;

- dynamic_account_tsq
- create_flexible_account

