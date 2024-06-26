<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Calendar Time Zone
    |--------------------------------------------------------------------------
    |
    | This value is the calendar time. This value is used when the
    | calendar time is start and end.
    |
    */
    'calendar' => [
        'start_time' => env('CALENDAR_START_TIME', '08:00'),
        'end_time' => env('CALENDAR_END_TIME', '18:00'),
    ],

    'default_language' => env('APP_DEFAULT_LANGUAGE'),
    'currency' => env('APP_CURRENCY', 'USD'),
    'currency_format' => env('APP_CURRENCY_FORMAT', '12345678.00'), // ####.##
    'currency_symbol' => env('APP_CURRENCY_SYMBOL', '$'),
    'currency_symbol_position' => env('APP_CURRENCY_SYMBOL_POSITION', 'left'),
    'start_day_of_week' => env('START_DAY_OF_WEEK', 'sunday'),
    'date_format' => env('DATE_FORMAT', 'd_m_Y'),
    'school_code' => env('SCHOOL_CODE', 'SHIKKHA-2023'),

    /*
    |--------------------------------------------------------------------------
    | Payment Options
    |--------------------------------------------------------------------------
    |
    | This options are used to configure the payment process for your application
    |
    */
    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
    'stripe_active' => env('STRIPE_ACTIVE', false),

    'razorpay_key' => env('RAZORPAY_KEY'),
    'razorpay_secret' => env('RAZORPAY_SECRET'),
    'razorpay_active' => env('RAZORPAY_ACTIVE'),

    'flw_public_key' => env('FLW_PUBLIC_KEY'),
    'flw_secret' => env('FLW_SECRET_KEY'),
    'flw_secret_hash' => env('FLW_SECRET_HASH'),
    'flw_active' => env('FLW_ACTIVE'),

    'midtrans_merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'midtrans_client_key' => env('MIDTRANS_CLIENT_KEY'),
    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY'),
    'midtrans_active' => env('MIDTRANS_ACTIVE'),
    'midtrans_live_mode' => env('MIDTRANS_LIVE_MODE', false),

    'paypal_sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
    'paypal_sandbox_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
    'paypal_live_client_id' =>  env('PAYPAL_LIVE_CLIENT_ID'),
    'paypal_live_secret' =>  env('PAYPAL_LIVE_CLIENT_SECRET'),
    'paypal_mode' => env('PAYPAL_MODE'),
    'paypal_active' => env('PAYPAL_ACTIVE', false),

    /*
    |--------------------------------------------------------------------------
    | SMS Options
    |--------------------------------------------------------------------------
    |
    | This options are used to configure the SMS gateway for your application
    |
    */
    'twilio_sid' => env('TWILIO_SID'),
    'twilio_token' => env('TWILIO_TOKEN'),
    'twilio_from' => env('TWILIO_FROM'),
    'twilio_active' => env('TWILIO_ACTIVE'),
];
