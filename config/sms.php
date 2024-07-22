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
    'default' => env('SMS_CLIENT', 'twilio'),

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

    'clients' => [

        'log' => [
            'provider' => 'log',
            'channel' => env('SMS_LOG_CHANNEL'),
        ],

        'array' => [
            'provider' => 'array',
        ],

        'twilio' => [
            'provider' => 'twilio',
            'account_sid' => env('SMS_TWILIO_ACCOUNT_SID'),
            'auth_token' => env('SMS_TWILIO_AUTH_TOKEN'),
            'from' => env('SMS_TWILIO_FROM'),
        ],

        'vonage' => [
            'provider' => 'vonage',
            'api_key ' => env('SMS_VONAGE_API_KEY'),
            'api_secret' => env('SMS_VONAGE_API_SECRET'),
            'from' => env('SMS_VONAGE_FROM'),
        ],

    ],
];
