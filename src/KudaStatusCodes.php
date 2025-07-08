<?php

namespace Giftbalogun\Kudaapitoken;

class KudaStatusCodes
{
    // Interbank Funds Transfer Codes
    public const INTERBANK = [
        '1'   => 'Processing',
        '01'  => 'Pending',
        '2'   => 'Successful',
        '00'  => 'Successful',
        '-1'  => 'Cancelled',
        '-2'  => 'Failed',
        '-3'  => 'Fatal Error',
        '91'  => 'Request Timeout',
    ];

    public const INTERBANK_TSQ = [
        '-4' => 'Failed And Reversed',
        '-2' => 'Failed And Reversal Pending',
        '1'  => 'Pending',
        '-5' => 'Record Not Found',
        '3'  => 'Manual Confirmation Required',
        '-1' => 'Debit Failed',
        '9'  => 'Invalid Request',
    ];

    public const KUDA_TO_KUDA = [
        '00' => 'Successful',
        '01' => 'Pending',
        '06' => 'Processing Error',
        '09' => 'Model Validation Error',
        '23' => 'PND on Tier 0 Accounts',
        '25' => 'No Record Found',
        '26' => 'Duplicate Transaction',
        'k26'=> 'Duplicate Request Reference',
        '28' => 'Force Debit Not Allowed',
        '30' => 'Format Error',
        '51' => 'Insufficient Balance',
        '52' => 'No Check Account',
        '57' => 'Transaction Permission',
        '58' => 'Transaction Not Permitted',
        '61' => 'Security Violation',
        '63' => 'Security Violation',
        '90' => 'Cut Off In Progress',
        'k91'=> 'Request Timeout',
        '93' => 'Exceeds Cash Limit',
        '96' => 'Fatal Error',
        '13' => 'Invalid Amount',
    ];

    public const KUDA_TO_KUDA_TSQ = [
        'k01' => 'Transaction Reversed',
        'k06' => 'Failed',
        'k25' => 'Record Not Found',
        '25'  => 'Record Not Found',
        '3'   => 'Manual Confirmation Required',
        '26'  => 'Duplicate Transaction',
        'k91' => 'Request Timeout',
    ];

    public const BILL_PURCHASE = [
        '00' => 'Transaction Successful',
        'K00'=> 'Operation Successful',
        'K57'=> 'Restricted Account',
        'K51'=> 'Insufficient Balance',
        'K61'=> 'Limit Reached',
        'K12'=> 'Aggregator Pending',
        'K11'=> 'Aggregator Failure',
        'K21'=> 'Invalid Request',
    ];

    public const BILL_PURCHASE_STATUS = [
        '1' => 'Pending',
        '2' => 'Failed',
        '3' => 'Completed',
        '4' => 'Retry',
        '5' => 'Default',
        '6' => 'Manual Reconciliation',
    ];

    public const BILL_PURCHASE_POSTING_STATUS = [
        '1' => 'Default',
        '2' => 'Successful',
        '3' => 'Failed',
        '4' => 'Unknown',
        '5' => 'Insufficient',
    ];

    public const BILL_PURCHASE_EXTENDED = [
        'k-OAPI-07' => 'No Account Found',
        'k10'       => 'Business Violation',
        'k11'       => 'Failed Transaction',
        '06'        => 'Error',
        'k12'       => 'Pending',
        'k25'       => 'No Record Found',
        'k26'       => 'Record Exists',
        'k09'       => 'Model Validation Error',
        'k06'       => 'General Error',
    ];

    /**
     * Retrieve message by code from a category.
     *
     * @param string $code
     * @param string $category
     * @return string|null
     */
    public static function getMessage(string $code, string $category): ?string
    {
        $categories = [
            'interbank'          => self::INTERBANK,
            'interbank_tsq'      => self::INTERBANK_TSQ,
            'kuda_to_kuda'       => self::KUDA_TO_KUDA,
            'kuda_to_kuda_tsq'   => self::KUDA_TO_KUDA_TSQ,
            'bill_purchase'      => self::BILL_PURCHASE,
            'bill_status'        => self::BILL_PURCHASE_STATUS,
            'bill_posting'       => self::BILL_PURCHASE_POSTING_STATUS,
            'bill_extended'      => self::BILL_PURCHASE_EXTENDED,
        ];

        if (!isset($categories[$category])) {
            return null;
        }

        return $categories[$category][$code] ?? null;
    }
}
