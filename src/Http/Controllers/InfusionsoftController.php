<?php

namespace RyanLHolt\Infused\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Infusionsoft\InfusionsoftException;
use RyanLHolt\Infused\Models\InfusionsoftToken;

class InfusionsoftController extends Controller
{
    public function finishAuthorize(Request $request)
    {
        $currentToken = InfusionsoftToken::where('user_id', Auth::id())->get('serialized_token');

        $status = 'Error authorizing Infusionsoft!';

        if (! $request->isMethod('get') || ! $request->has('code')) {
            redirect(route('infused.infusionsoft.settings'))
                      ->with('infused_status', $status);
        }

        $newToken = null;
        try {
            $newToken = app('infused')
                ->infusionsoft()
                ->requestAccessToken($request->query('code'));
        } catch(InfusionsoftException $infusionsoftException) {
            $exceptionReason = $infusionsoftException . getHelpText();
            app('log')->warning($exceptionReason);
        }

        if ($currentToken !== serialize($newToken) && null !== $newToken->getAccessToken()) {
            //Token is good, store it
            app('infused')->updateToken($newToken);

            $status = 'Infusionsoft Token was successfully set!';
        }

        return redirect(route('infused.infusionsoft.settings'))->with('infused_status', $status);
    }

    public function settings()
    {
        return view('infused::settings');
    }
}
