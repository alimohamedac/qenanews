<?php

return [
    'name'           => env('APP_NAME'),
    'admin-theme'    => env('ADMIN_THEME', 'yallacolors'),
    'frontend-theme' => env('FRONTEND_THEME', 'blog'),
    'auth-theme'     => env('AUTH_THEME', 'yallacolors'),
    'admin-prefix'   => env('ADMIN_PREFIX', 'admin'),
    'webmaster-mail' => env('WEBMASTER_MAIL'),
    //'multi-language' => env('MULTI_LANGUAGE', false),
    'default-lang'   => env('DEFAULT_LANGUAGE', 'ar'),

    'prefix'        => [
        'frontend'  => null,
        'admin'     => null,
    ],

    'middleware'=>  [
        'frontend'  =>  [],
    ],
];
