<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Giftbalogun\Kudaapitoken\kuda;

class SavingController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    public function get_spend_save_transactions(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::RETRIEVE_SPEND_AND_SAVE_TRANSACTIONS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function create_saving_plan(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::CREATE_PLAIN_SAVINGS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function get_saving_plan(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_PLAIN_SAVINGS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function get_all_customer_saving_plan(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_ALL_CUSTOMER_PLAIN_SAVINGS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function get_all_saving_plan(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_ALL_PLAIN_SAVINGS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function update_plain_saving(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::UPDATE_PLAIN_SAVINGS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function plain_saving_transaction(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::PLAIN_SAVINGS_TRANSACTIONS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function retrieve_plain_savings_transactions(
        array $data,
        $requestRef
    ) {
        $servicetype = ServiceTypes::RETRIEVE_PLAIN_SAVINGS_TRANSACTIONS;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    // /Flexible
    //Money is moved from the user's account periodically (daily, weekly, monthly) to the savings account.
    public function create_open_flexible_save(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::CREATE_OPEN_FLEXIBLE_SAVE;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function create_close_flexible_save(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::CREATE_CLOSED_FLEXIBLE_SAVE;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function get_open_flexible_save($data, $requestRef)
    {
        $servicetype = ServiceTypes::CREATE_CLOSED_FLEXIBLE_SAVE;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }

    public function get_closed_flexible_save(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::CREATE_CLOSED_FLEXIBLE_SAVE;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $payload, $requestRef);

        return $result;
    }
}
