<?php

return [
    'secret' => env('RECAPTCHA_SECRET'),
    'sitekey' => env('RECAPTCHA_SITEKEY'),
    'active' => env('RECAPTCHA_ACTIVE'),
    'options' => [
        'timeout' => 30,
    ],
];
