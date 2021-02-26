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

        $result = app('infusionsoft')->getToken()
            ? app('infused')->getAccessToken()
            : app('infused')->getAccessToken($request->query('code'));

        $request->session()->flash('status', $result ? 'Infusionsoft Token was successfully set!' : 'Error authenticating Infusionsoft');

        redirect(config('infused.infused_auth_url'));
    }
}
