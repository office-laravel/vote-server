<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Code
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = auth()->guard('client')->user();

        if(auth()->guard('client')->check() && $client->code){

            // if(!$request->is('verify*')){       // route in web.php his url 'verify' ... 
                                                // * is all functions in CodeController

               return redirect()->route('verify.index');
                                            
            // }
        }

        return $next($request);
    }
}
