<?php

namespace Joukhar\LaravelNoCaptchaV3\LaravelNoCaptchaV3\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoCaptchaV3Controller extends Controller
{
    public function reCaptchaResponse()
    {
        if (config('laravel-no-captcha-v3.enable') == 'on') {
            $recaptchaResult = $this->reCaptchaCheck(request('recaptcha'));

            if ($recaptchaResult->success != true) {
                return 'Google reCaptcha Validation has Failed';
                return redirect()->back()->with('error', 'Google reCaptcha Validation has Failed');
            }

            if ($recaptchaResult->score >= 0.5) {
                return 'safe';
            } else {
                return 'not safe';
            }
        }
        return 'false';
    }

    private function reCaptchaCheck($recaptcha)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = request()->ip();

        $data = [
            'secret' => config('services.google.recaptcha.secret_key'),
            'response' => $recaptcha,
            'remoteip' => $remoteip
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        return $resultJson;
    }
}
