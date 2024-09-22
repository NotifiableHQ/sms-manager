<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Default Client
   |--------------------------------------------------------------------------
   |
   | This option controls the default client that is used to send all SMS
   | messages unless another client is explicitly specified when sending
   | the message. All additional clients can be configured within the
   | "clients" array. Examples of each type of client are provided.
   |
   */
    'default' => env('SMS_CLIENT', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Client Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all the clients used by your application plus
    | their respective settings. Several examples have been configured for
    | you, and you are free to add your own as your application requires.
    |
    | Available providers: "vonage", "twilio", "log", "array"
    |
    */

    'messengers' => [

        'log' => [
            'client' => 'log',
            'channel' => env('SMS_LOG_CHANNEL'),
        ],

        'array' => [
            'client' => 'array',
        ],

        'twilio' => [
            'client' => 'twilio',
            'account_sid' => env('SMS_TWILIO_ACCOUNT_SID'),
            'auth_token' => env('SMS_TWILIO_AUTH_TOKEN'),
            'from' => env('SMS_TWILIO_FROM'),
        ],

        'vonage' => [
            'client' => 'vonage',
            'key ' => env('SMS_VONAGE_KEY'),
            'secret' => env('SMS_VONAGE_SECRET'),
            'from' => env('SMS_VONAGE_FROM'),
        ],

    ],
];
