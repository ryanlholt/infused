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

    'infused_auth_url' => env('INFUSED_AUTH_URL', env('APP_URL', 'http://localhost').'/infused'),

];
