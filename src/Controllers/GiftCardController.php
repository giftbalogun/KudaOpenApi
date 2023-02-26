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

}
