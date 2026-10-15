<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    // Hardcoded Mailjet SMTP for the contact form (no MAIL_* required in .env).
    // Tests may still override with MAIL_MAILER=array via phpunit.xml.
    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => 'smtp',
            'url' => null,
            'host' => 'in-v3.mailjet.com',
            'port' => 587,
            'username' => 'e8dd6259ba8e8b988006f13c80a5ec8f',
            'password' => '3dcc6c2c3e843ae1d32ad3dae279d950',
            'timeout' => 30,
            // Avoid EHLO as 127.0.0.1 from APP_URL, which some SMTP relays mishandle.
            'local_domain' => 'madhusudantimalsina.com.np',
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        'address' => 'timmadh@gmail.com',
        'name' => 'Madhusudan Timalsina',
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Form Inbox
    |--------------------------------------------------------------------------
    |
    | Messages submitted through the portfolio contact form are delivered here.
    | Do not use the reserved top-level "to" / "reply_to" mail keys — Laravel
    | treats those as global always-on addresses and expects a name field.
    |
    */

    'contact_to' => 'timmadh@gmail.com', // owner inbox for contact form submissions

];
