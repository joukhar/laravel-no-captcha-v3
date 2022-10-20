<?php

namespace Joukhar\LaravelNoCaptchaV3;

use Illuminate\Support\ServiceProvider;

class LaravelNoCaptchaV3 extends ServiceProvider
{
    public function boot()
    {
        /* -------------------------------------------------------------------------- */
        /* Publish Config                                                             */
        /* -------------------------------------------------------------------------- */
        $this->publishes([
            __DIR__ . '/src/config/laravel-no-captcha-v3.php' => config_path('laravel-no-captcha-v3.php'),
        ],'laravel-no-captcha-v3-config');

        /* -------------------------------------------------------------------------- */
        /* Publish Views                                                              */
        /* -------------------------------------------------------------------------- */
        $this->publishes([
            __DIR__ . '/src/resources/views' => resource_path('views/vendor/laravel-no-captcha-v3'),
        ],'laravel-no-captcha-v3-views');

        /* -------------------------------------------------------------------------- */
        /* Load Views                                                                 */
        /* -------------------------------------------------------------------------- */
        $this->loadViewsFrom(__DIR__ . '\src\resources\views', 'NoCaptchaV3');
    }

    public function register()
    {
        /* -------------------------------------------------------------------------- */
        /* Merge Configuration                                                        */
        /* -------------------------------------------------------------------------- */
        $this->mergeConfigFrom(
            __DIR__ . '/src/config/laravel-no-captcha-v3.php',
            'laravel-no-captcha-v3'
        );
    }
}
