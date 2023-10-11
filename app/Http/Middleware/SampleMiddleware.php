<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $tambahanparameter1, string $tambahanparameter2)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == 'KEY123') {
            return $next($request);
        } 

        return response("Access denied", 401);
    }
}
