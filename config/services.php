<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('sandbox008d17e45e5d47a89dc299ef944a2155.mailgun.org'),
        'secret' => env('key-702ae6674e2372c6583b18feb2d69c3f'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        // 코드 24-2
        'client_id' => env('1085d2fa78e807056497'),
        'client_secret' => env('0c3e6ae6ef386d05c8df277734860c1dc30a38ea'),
        'redirect' => env('http://0.0.0.0:8002/social/github'),
    ],

];
