<?php

namespace RyanLHolt\Infused\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Infusionsoft\InfusionsoftException;

class InfusionsoftController extends Controller
{
    public function storeToken(Request $request){
        if (!$request->isMethod('get') || !$request->has('code')){
            abort(400, "Bad Request");
        }

        if (!app('infusionsoft')->getToken()) {
            try {
                $token = app('infusionsoft')->requestAccessToken($request->query('code'));
                app('infused')->updateToken($token);
            } catch(InfusionsoftException $e){
                Log::error("Error getting token: " . $e->getMessage());
                // Note: We will want to redirect back to an Infusionsoft authorization page here
            }
        } else {
            try{
                $token = app('infusionsoft')->refreshAccessToken();
                app('infused')->updateToken($token);
            } catch(InfusionsoftException $e){
                Log::error("Error refreshing token: " . $e->getMessage());
                //Note: We will want to redirect back to an Infusionsoft authorization page here
            }
        }
    }
}
