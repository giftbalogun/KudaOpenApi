<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Giftbalogun\Kudaapitoken\kuda;

class BillController extends Controller
{
    public function __construct()
    {
        $this->kuda = new Kuda();
    }

	//https://kudabank.gitbook.io/kudabank/kuda-api-documentation/kuda-bill-paymnet-and-betting-services-api
	//Use Available Billers - Airtime, Betting, Internet Data, Electricity, Cable TV	
    public function get_biller_type(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_BILLERS_BY_TYPE;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
	
	//https://kudabank.gitbook.io/kudabank/kuda-api-documentation/kuda-bill-paymnet-and-betting-services-api/verifying-a-customer-before-purchasing-a-bill
	public function verify_bill_customer(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::VERIFY_BILL_CUSTOMER;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

	//https://kudabank.gitbook.io/kudabank/kuda-api-documentation/kuda-bill-paymnet-and-betting-services-api/purchasing-a-bill
	public function admin_purchase_bill(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_PURCHASE_BILL;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

	public function purchase_bill(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::PURCHASE_BILL;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

	public function bill_tsq(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::BILL_TSQ;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

	public function admin_get_purchased_bills(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_GET_PURCHADED_BILLS;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

	public function get_purchased_bills(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_PURCHADED_BILLS;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
}
