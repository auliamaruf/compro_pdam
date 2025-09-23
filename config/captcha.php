<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'options' => [
        'timeout' => 30,
        'theme' => 'light',
        'size' => 'normal',
        'tabindex' => 0,
    ],
    'lang' => 'id',
    'curl_timeout' => 30,
    'attributes' => [
        'theme' => 'light',
    ],
];