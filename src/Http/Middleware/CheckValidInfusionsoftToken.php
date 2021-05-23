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
        $userId = Auth::user()->id;
        $token = InfusionsoftToken::where('user_id', $userId);

        if($token){
            app('infusionsoft')->setToken($token);

            if($token->end_of_life < now()){
                try {
                    app('infusionsoft')->refreshAccessToken();
                } catch(InfusionsoftException $e) {
                    $e->getMessage();
                    // @todo: Add in config var for infusionsoft authorization route and redirect there.
                }
            }
        } else {
            // @todo: Add in config var for infusionsoft authorization route and redirect there.
        }

        return $next($request);
    }
}
