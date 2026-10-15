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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    | Cloudflare Turnstile (contact form captcha). Hardcoded — no .env keys needed.
    */
    'turnstile' => [
        'site_key' => '0x4AAAAAAFXRmG-DdwRA9r-2',
        'secret_key' => '0x4AAAAAAFXRmNLMrdhaEyHuujo-KXaQjus',
        'verify_url' => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
    ],

    /*
    | Mailjet API (contact form mail). Same credentials as SMTP username/password.
    */
    'mailjet' => [
        'key' => 'e8dd6259ba8e8b988006f13c80a5ec8f',
        'secret' => '3dcc6c2c3e843ae1d32ad3dae279d950',
    ],

];
