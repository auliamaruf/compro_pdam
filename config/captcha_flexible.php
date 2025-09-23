<?php

return [
    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Configuration
    |--------------------------------------------------------------------------
    | Configuration for Google reCAPTCHA integration
    */

    'version' => env('RECAPTCHA_VERSION', 'v2'), // v2 or v3
    
    // reCAPTCHA v2 settings
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'secret' => env('NOCAPTCHA_SECRET'),
    'options' => [
        'timeout' => 30,
        'theme' => 'light', // light or dark
        'size' => 'normal', // normal, compact, invisible
    ],

    // reCAPTCHA v3 settings (if using v3)
    'v3' => [
        'sitekey' => env('RECAPTCHA_V3_SITEKEY'),
        'secret' => env('RECAPTCHA_V3_SECRET'),
        'threshold' => env('RECAPTCHA_V3_THRESHOLD', 0.5),
        'action' => env('RECAPTCHA_V3_ACTION', 'submit'),
    ],

    // Verification settings
    'verify_url' => 'https://www.google.com/recaptcha/api/siteverify',
    
    // Debug settings
    'debug' => env('APP_DEBUG', false),
    'curl_timeout' => 10,
];