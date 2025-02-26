<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'recaptcha' => [
        'sitekey' => env('RECAPTCHA_SITE_KEY'),
        'secret' => env('RECAPTCHA_SECRET_KEY'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slotgator' => [
        'merchant_id' => env('MERCHANT_ID'),
        'merchant_key' => env('MERCHANT_Key'),
        'base_api_url' => env('BASE_API_URL'),
        'merchant_api_callback_url' => env('MERCHANT_APU_CALLBACK_URL'),
    ],

    'slotgator_test' => [
        'merchant_id' => env('STAGE_MERCHANT_ID'),
        'merchant_key' => env('STAGE_MERCHANT_Key'),
        'base_api_url' => env('STAGE_BASE_API_URL'),
        'merchant_api_callback_url' => env('MERCHANT_APU_CALLBACK_URL'),
    ],

    'sky_pay' => [
        'token' => env('SKY_PAY_TOKEN'),
        'base_url' => env('SKY_PAY_BASE_URL'),
    ],

    'paymentpro' => [
        'public_key' => env('PAYMENTPRO_PUBLIC_KEY'),
        'private_key' => env('PAYMENTPRO_PRIVATE_KEY'),
        'api_url' => env('PAYMENTPRO_API_URL'),
    ],

    'oxprocessing' => [
        'api_key' => env('OX_API_KEY'),
        'base_url' => env('OX_API_BASE_URL', "https://app.0xprocessing.com/Payment/"),
    ],
    
    'app' => [
        'commission' => env('SEND_MONEY_FRIEND_COMMISION')
    ]
];
 