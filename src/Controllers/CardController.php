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
| CARDCONTROLLER
|--------------------------------------------------------------------------
*/
class CardController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    //Allow customers request for cards via your fintech app
    public function requestcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::REQUEST_CARD;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //​This is a front facing service. Give your customers the ability to see a list of cards they have requested through you.
    public function getcustomercard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_CUSTOMER_CARDS;

        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //​Allow your customers activate their cards when received.
    public function activatecard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ACTIVATE_CARD;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

     //Allow customers request for cards via your fintech app
    public function deactivatecard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::DEACTIVATE_CARD;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Manage individual card limits 
    public function managecardlimit(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::MANAGE_CARD_TRANSACTION_LIMIT;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Manage where your card can be used
    public function managecardchannel(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::MANAGE_CARD_CHANNEL;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //​When a card is requested, we generate a pin for the card, it is required that before this card can be used across any channel, the user must check the pin and then change the pin.
    public function getcardpin(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::GET_CARD_PIN;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Manage individual card limits 
    public function changecardpin(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::CHANGE_CARD_PIN;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Manage individual card limits 
    public function blockcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::BLOCK_CARD;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    //Manage individual card limits 
    public function unblockcard(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::UNBLOCK_CARD;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

}
