# Availabile Commands to use under KudaApiToken

# Banking API
use Giftbalogun\Kudaapitoken\Controllers\KudaBankController;

- name_enquiry
- getBankList
- create_virtual_account
- update_virtual_account
- disable_virtual_account
- enable_virtual_account
- getadminbalance
- retrieve_all_virtual_account
- retrieve_virtual_account
- retrieve_virtual_account_balance
- admin_main_account_transaction
- retrieve_virtual_account_transaction
- withdraw_virtual_account
- webhook
- single_fund_transfer
- virtual_fund_transfer
- fund_virtual_account


# Bill/Utility API
use Giftbalogun\Kudaapitoken\Controllers\BillController;

- get_biller_type
- verify_bill_customer
- admin_purchase_bill
- purchase_bill
- bill_tsq
- admin_get_purchased_bills
- get_purchased_bills


# Savings API
use Giftbalogun\Kudaapitoken\Controllers\SavingController;

- get_spend_save_transactions
- create_saving_plan
- get_saving_plan
- get_all_customer_saving_plan
- get_all_saving_plan
- update_plain_saving
- plain_saving_transaction
- retrieve_plain_savings_transactions
- create_open_flexible_save
- create_close_flexible_save
- get_open_flexible_save
- get_closed_flexible_save


# GiftCard API
use Giftbalogun\Kudaapitoken\Controllers\GiftCardController;

- getgiftcard
- admin_buygiftcard
- buygiftcard
- giftcard_tsq


# KudaCard API
use Giftbalogun\Kudaapitoken\Controllers\CardController;

- requestcard
- getcustomercard
- activatecard
- deactivatecard
- managecardlimit
- managecardchannel
- getcardpin
- changecardpin
- blockcard
- unblockcard

