<?php

namespace Giftbalogun\Kudaapitoken\Controllers;

use Illuminate\Routing\Controller;
use Giftbalogun\Kudaapitoken\Controllers\ServiceTypes;
use Giftbalogun\Kudaapitoken\kuda;

class GiftCardController extends Controller
{
    public function __construct()
    {
        $this->kuda = new Kuda();
    }

    
}
