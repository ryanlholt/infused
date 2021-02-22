<?php

namespace RyanLHolt\Infused\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InfusionsoftController extends Controller
{
    public function storeToken(Request $request)
    {
        if (! $request->isMethod('get') || ! $request->has('code')) {
            abort(400, 'Bad Request');
        }

        if (! app('infusionsoft')->getToken()) {
            app('infused')->getAccessToken($request->query('code'));
        } else {
            app('infused')->getAccessToken();
        }
    }
}
