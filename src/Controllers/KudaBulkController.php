<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\kuda;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
/**
 * KudaOpenApi laravel package
 * @author Gift Balogun - amdeone <balogunigift@gmail.com>
 * @version 1
 **/

/*
|--------------------------------------------------------------------------
| KudaBulkController
|--------------------------------------------------------------------------
*/
class KudaBulkController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    public function bulk_name_enquiry(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::BULK_NAME_ENQUIRY;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function collect_acc_bulk_pay(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::DYNAMIC_COLLECTION_ACCOUNT_TSQ;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function main_acc_bulk_pay(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::MAIN_ACCOUNT_BULK_PAYMENT;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function bulk_payment_tsq(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::BULK_PAYMENT_TSQ;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
}
