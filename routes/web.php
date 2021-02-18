<?php

use Illuminate\Http\Request;


Route::get('/infusionsoft/callback', function(Request $request){
    if($request->isMethod('get') && $request->has('code'))
    {
        if (!app('infusionsoft')->getToken())
        {
            $token = app('infusionsoft')->requestAccessToken($request->query('code'));

            dd($token);
        }
    }
});
