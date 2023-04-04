<h1 align="center">KudaOpenAPI Integration in Laravel</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="Star" src="https://img.shields.io/github/stars/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="GitHub issues" src="https://img.shields.io/github/issues/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/giftbalogun/kudaApiToken?style=plastic&color=56BEB8">
</p>

<!-- Status -->

<h4 align="center">
	Laravel integration with KudaApiToken for seemless Banking via Kuda Bank Open Api
</h4>

<hr>

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0;
  <a href="#dart-installation">Installation</a> &#xa0; | &#xa0;
  <a href="#sparkles-usage">Usage</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/giftbalogun" target="_blank">Author</a>
</p>

<br>

## :dart: Getting Started

Enable your product for local transactions with the KUDA Open API platform! With the KUDA Open APIs you can embed services unto your platform and connect your customers to a wide range of banking services.

Before you proceed, ensure you have a [KUDA Business account](https://business.kuda.com/)!. You can link this account to your profile to get approved for live. 

Generate a token from your developer dashboard.

## :dart: Installation

[PHP](https://php.net) 7.2+ and [Composer](https://getcomposer.org) are required.

To get the latest version of KudaApiToken, simply require it

```bash
composer require giftbalogun/kudapaitoken
```

Or add the following line to the require block of your `composer.json` file.

```
"giftbalogun/kudapaitoken": "1.0.*"
```

and add This

```
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/giftbalogun/kudaApiToken"
    }
],
```

You'll then need to run `composer install` or `composer update --prefer-dist` to download it and have the autoloader updated.

Open your .env file and add your public key, secret key, merchant email and payment url like so:

```php
KUDA_API_TOKEN=XXXXXXXXXXXXXXXXXXXX
KUDA_API_URL=XXXXXXXXXXXXXXXXXXXXXX
KUDA_USER_EMAIL=YOUR_EMAIL
ENVIRONMENT_ENV=LIVE_OR_TEST
```

## :star: Documentation
Documentation
http://kudaapitoken.readthedocs.io (COMING SOON)

Article Medium to Read
https://medium.com/@giftbalogun/laravel-integration-with-kudaopenapi-663825ecd247

## :sparkles: Usage
Availbale coomand to be use are in `COMMAND.md` with easy to understand related to ServiceTypes.

Send request with this command.
```php

$data = [
    'email' => $request->email,
    'phoneNumber' => $request->phone,
    'lastName' => $request->l_name,
    'firstName' => $request->f_name,
    'businessName' => $request->business_name,
    'trackingReference' => $customer_code,
]; # $data is the format for making request to the api 

$ref = rand(); #used to generate randon unique number for the request

```

Styles of Calling the Controller
```php
use Giftbalogun\Kudaapitoken\Controllers\KudaBankController;

$this->kudabankservice->create_virtual_account($data, $ref);
```
OR

```php
use Giftbalogun\Kudaapitoken\Kuda;

$this->kuda->initController('default')->create_virtual_account($data, $ref);
## Controllers include 'Bill', 'Card', 'GiftCard', 'KudaBank' | Default is same as KudaBank
```

# Create New Customer Accunt

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Giftbalogun\Kudaapitoken\Controllers\KudaBankController;
use Giftbalogun\Kudaapitoken\Kuda;

class CustomController extends Controller
{
    private $kuda;
    private $kudabankservice;

    public function __construct()
    {
        $this->kudabankservice = new KudaBankController();
        ## Or call from Kuda service
        $this->kuda = new Kuda;
    }

    public function createcustomeraccount()
    {
        $customer_code = '000' . random_int(100000, 999999) . '0000';

        $data = [
            'email' => $request->email,
            'phoneNumber' => $request->phone,
            'lastName' => $request->l_name,
            'firstName' => $request->f_name,
            'businessName' => $request->business_name,
            'trackingReference' => $customer_code,
        ];
        $ref = rand();

        $newcustomeraccount = $this->kudabankservice->create_virtual_account($data, $ref);

        ## Or you can load from the Kuda Service
        
        $newcustomeraccount = $this->kuda->initController('default')->create_virtual_account($data, $ref);
        ## Controllers include 'Bill', 'Card', 'GiftCard', 'KudaBank' | Default is same as KudaBank

        $getvaccount = json_decode($newcustomeraccount['data']);

        return $getvaccount;
    }
}
```

# Get Admin Balance

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Giftbalogun\Kudaapitoken\Kuda;

class CustomController extends Controller
{
    private $kuda;
    private $kudabankservice;

    public function __construct()
    {
        ##Kuda service
        $this->kuda = new Kuda;
    }

    public function getadminbalance()
    {
        $data = [];

        $ref = rand();

        ##load from the Kuda Service
        $balance = $this->kuda->initController('KudaBank')->getadminbalance($data, $ref);
        ## Controllers include 'Bill', 'Card', 'GiftCard', 'KudaBank' | Default is same as KudaBank

        $getadminbalance = json_decode($balance['data']);

        return $getadminbalance;
    }
}
```

## :memo: License

This project is under license from MIT. For more details, see the [LICENSE](LICENSE.md) file.

## Social Presense
Follow me on social media
[Medium](https://medium.com/@giftbalogun)!
[Twitter](https://twitter.com/am_de_one)!
[Instagram](https://www.instagram.com/am_thd_one/)!
[LinkedIn](https://www.linkedin.com/in/gift-balogun-907103160/)!
[Porfolio](https://giftbalogun.name.ng/)!

Made with :heart: by <a href="https://giftbalogun.name.ng" target="_blank">Gift Balogun</a>

&#xa0;

<a href="#top">Back to top</a>
