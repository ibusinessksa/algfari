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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    | Maps JavaScript API + Places (لنموذج موقع المناسبة في لوحة Filament).
    | فعّل في Google Cloud: Maps JavaScript API و Places API.
    */
    'google_maps' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY'),
    ],

    /*
    | SMS provider (Unifonic by default — drop-in compatible vendors can be added later).
    */
    'sms' => [
        'driver' => env('SMS_DRIVER', 'log'),
        'unifonic' => [
            'app_sid' => env('UNIFONIC_APP_SID'),
            'sender_id' => env('UNIFONIC_SENDER_ID', 'AlGafari'),
            'endpoint' => env('UNIFONIC_ENDPOINT', 'https://el.cloud.unifonic.com/rest/SMS/messages'),
        ],
    ],

];
