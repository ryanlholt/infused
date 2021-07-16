<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Authentication Redirect
    |--------------------------------------------------------------------------
    |
    | Here you specify where you want the user to be redirected after
    | they authenticate the application with Infusionsoft.
    |
    */

    'prefix' => 'infusionsoft',
    'middleware' => ['web', 'auth'],
    'infusionsoftAuthorize' => env('INFUSIONSOFT_AUTHORIZE_ROUTE', '/authorize'),
    'infusionsoftSettings' => env('INFUSIONSOFT_SETTINGS_ROUTE', '/settings'),
    'infusionsoft' => [
        'clientId' => env('INFUSIONSOFT_CLIENT_ID'),
        'clientSecret' => env('INFUSIONSOFT_SECRET'),
        'redirectUri' => env(
            'INFUSIONSOFT_REDIRECT_URL',
            env('APP_URL', 'http://localhost') . '/infusionsoft/authorize'
        ),
    ],
];
