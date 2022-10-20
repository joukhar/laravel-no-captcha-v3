# Laravel No Captcha V3

[![License](https://img.shields.io/github/license/joukhar/laravel-no-captcha-v3)](https://packagist.org/packages/joukhar/laravel-no-captcha-v3)
[![Total Downloads](http://poser.pugx.org/joukhar/laravel-no-captcha-v3/downloads)](https://packagist.org/packages/joukhar/laravel-no-captcha-v3)
[![Isues](https://img.shields.io/github/issues/joukhar/laravel-no-captcha-v3)](https://packagist.org/packages/joukhar/laravel-no-captcha-v3)

## Installation

Add the new required package in your composer.json

```
"joukhar/laravel-no-captcha-v3": "^1.0"
```
Run `composer update` or `php composer.phar update`.

Or install directly via composer

```
composer require joukhar/laravel-no-captcha-v3
```

## Requirements
Require php >= 7.4

## Configuration

You can override the default options for The Package. First publish the configuration:

```
php artisan vendor:publish --provider="Joukhar\LaravelNoCaptchaV3\LaravelNoCaptchaV3" --tag=laravel-no-captcha-v3-config
```

then Add The following keys to .env file to turn on/off the recaptcha ex:

```
ENABLE_NO_CAPTCHA=on
GOOGLE_RECAPTCHA_SITE_KEY=
GOOGLE_RECAPTCHA_SECRET_KEY=
```

And Add your Recaptcha Credentials in the config file:

```php
     'recaptcha' => [
        'site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY'),
        'secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY')
    ]
```

you can get them here https://www.google.com/u/1/recaptcha/admin/create

## Views

If You want to override the default views, you can publish them via:

```
php artisan vendor:publish --provider="Joukhar\LaravelNoCaptchaV3\LaravelNoCaptchaV3" --tag=laravel-no-captcha-v3-views
```

## Usage

#### in the routes file (web.php)

```php
Route::post('submit-form', [TestController::class, 'handleFormSubmission']);
```

#### in the blade file

```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <form action="{{ route('validate-form') }}" method="post">
        @csrf
        @include('NoCaptchaV3::recaptcha-input')

        <button type="submit">Submit Form</button>
    </form>


    {{--  --------------------------------------------------------------------  --}}
    {{-- Your Scripts                                                           --}}
    {{--  --------------------------------------------------------------------  --}}
    @include('NoCaptchaV3::recaptcha-script')

</body>

</html>

```

#### in the controller which associated with previous blade file 

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Joukhar\LaravelNoCaptchaV3\Http\Controllers\NoCaptchaV3Controller;

class TestController extends Controller
{
    public function handleFormSubmission(Request $request, NoCaptchaV3Controller $noCaptchaV3Controller)
    {
        $request->validate([
            'recaptcha' => 'required'
        ]);
        // if reCaptcha Validation has Failed, it will return 'Google reCaptcha Validation has Failed';
        // if reCaptcha score >= 0.5, it will return 'safe' otherwise it will return 'not safe' ;
        // if ENABLE_NO_CAPTCHA = off , it will return 'false' ;

        $recaptchaResult = $noCaptchaV3Controller->reCaptchaResponse();
    
        // conclusion
        if ($recaptchaResult == 'safe') {
            // your code
        }
    }
}

```


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

