<h1 align="center">KudaApiToken Integration in Laravel</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="Issues" src="https://img.shields.io/github/issues/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="Star" src="	https://img.shields.io/github/stars/giftbalogun/kudaApiToken?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/giftbalogun/?style=plastic&color=56BEB8">
</p>

<!-- Status -->

<h4 align="center">
	Laravel KudaApiToken for seemless banking via Kuda open pi
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

## :dart: About

Describe your project

## :dart: Installation

[PHP](https://php.net) 5.4+ and [Composer](https://getcomposer.org) are required.

To get the latest version of KudaApiToken, simply require it

```bash
composer require giftbalogun/kudapaitoken
```

Or add the following line to the require block of your `composer.json` file.

```
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/giftbalogun/kudaApiToken"
    }
],
```

and add This

```
"giftbalogun/kudapaitoken": "1.0.*"
```

You'll then need to run `composer install` or `composer update --prefer-dist` to download it and have the autoloader updated.

Open your .env file and add your public key, secret key, merchant email and payment url like so:

```php
KUDA_API_TOKEN=XXXXXXXXXXXXXXXXXXXX
KUDA_API_URL=XXXXXXXXXXXXXXXXXXXXXX
KUDA_USER_EMAIL=BLGNBALOGUN53@GMAIL.COM
```

## :sparkles: Usage


```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Giftbalogun\Kudaapitoken\Controllers\KudaBankController;

class CustomController extends Controller
{
    private $kudabankservice;

    public function __construct()
    {
        $this->kudabankservice = new KudaBankController();
    }

    public function createcustomeraccount()
    {
        $customer_code = '000' . random_int(100000, 999999) . '0000';

        $data = [
            'email' => $request->email,
            'phoneNumber' => $request->phone,
            'lastName' => $request->l_name,
            'firstName' => $request->f_name,
            'trackingReference' => $customer_code,
        ];
        $ref = rand();

        $newcustomeraccount = $this->kudabankservice->create_virtual_account($data, $ref);

        $getvaccount = json_decode($newcustomeraccount['data']);

        return $getvaccount;
    }
}
```
## :memo: License

This project is under license from MIT. For more details, see the [LICENSE](LICENSE.md) file.

Don't forget to [follow me on twitter](https://twitter.com/amdeone)!
Made with :heart: by <a href="https://github.com/giftbalogun" target="_blank">Gift Balogun</a>

&#xa0;

<a href="#top">Back to top</a>
