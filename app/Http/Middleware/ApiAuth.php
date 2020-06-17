<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //se non c'è authorization errore
        $tokenHeader = $request->header('Authorization');

        if(empty($tokenHeader)) {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'Authorization assente'
                ]
            );
        }

        // prendiamo dati authorization
        $apiKey = 'Bearer ' . config('app.api_key');

        //se bearer non corrisponde errore
        if($tokenHeader != $apiKey) {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'authorization errata'
                ]
            );
        }

        return $next($request);
    }
}
