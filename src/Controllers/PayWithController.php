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
| PayWithController
|--------------------------------------------------------------------------
*/
class PayWithController extends Controller
{
    private Kuda $kuda;

    public function __construct()
    {
        $this->kuda = app(Kuda::class);
    }

    public function create_flexible_account(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::ADMIN_CREATE_DYNAMIC_COLLECTION_ACCOUNT;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }

    public function dynamic_account_tsq(array $data, $requestRef)
    {
        $servicetype = ServiceTypes::DYNAMIC_COLLECTION_ACCOUNT_TSQ;
        $payload = $data;
        $result = $this->kuda->makeRequest($servicetype, $data, $requestRef);

        return $result;
    }
}
