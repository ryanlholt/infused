<?php

namespace RyanLHolt\Infused\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $sessionToken = $request->session()->get('infused_ifs_token', false);
        $storedToken = InfusionsoftToken::where('user_id', Auth::user()->id)->query('serialized_token');

        if (! isset($storedToken)) {
            $request->session()->flash('infused_auth_status', 0);
        }

        if ($sessionToken !== $storedToken) {
            $request->session()->put('infused_ifs_token', $storedToken);
            app('infused')->infusionsoft()->setToken($storedToken);

            $request->session()->flash('infused_auth_status', 1);

            if (app('infused')->infusionsoft()->isTokenExpired()) {
                try {
                    app('infused')->infusionsoft()->refreshAccessToken();
                    app('infused')->updateToken(app('infused')->infusionsoft()->getToken());
                } catch (InfusionsoftException $e) { // This may end up being an HTTP exception instead
                    $e->getMessage();
                    $request->session()->flash('infused_auth_status', 0);
                }
            }
        } else {
            $request->session()->flash('infused_auth_status', 1);
        }

        return $next($request);
    }
}
