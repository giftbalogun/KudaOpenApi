<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Giftbalogun\Kudaapitoken\kuda;

class GiftCardController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    // View List of Gift Cards
    //https://kudabank.gitbook.io/kudabank/kuda-api-documentation/kuda-gift-cards/view-list-of-gift-cards
    public function getgiftcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_GIFT_CARD;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function admin_buygiftcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_BUY_GIFT_CARD;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
    
    //Purchase a gift card from your virtual accounts
    public function buygiftcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::BUY_GIFT_CARD;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Get a Purchase Status for any gift card purchase
    public function giftcard_tsq(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GIFT_CARD_TSQ;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
}
