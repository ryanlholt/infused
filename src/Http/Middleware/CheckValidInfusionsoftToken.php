<?php

namespace RyanLHolt\Infused\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Infusionsoft\InfusionsoftException;
use RyanLHolt\Infused\Models\InfusionsoftToken;

class CheckValidInfusionsoftToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ifs_token = $request->session()->get('infused_ifs_token', false);

        if ($ifs_token) {
            app('infused')->infusionsoft->setToken($ifs_token);
        }

        $stored_ifs_token = InfusionsoftToken::where('user_id', Auth::user()->id);

        if ($stored_ifs_token !== $ifs_token || $ifs_token->end_of_life < now()) {
            try {
                app('infused')->infusionsoft->refreshAccessToken();
            } catch (InfusionsoftException $e) {
                $e->getMessage();
                /**
                 * @todo: Add in config var for infusionsoft authorization
                 * route and redirect there.
                 */
            }
        }

        if (!$ifs_token) {
            Session::put('infused_ifs_token', $stored_ifs_token);
        }

        return $next($request);
    }
}
