<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleDemoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (env("DEMO_MODE") == "On" &&  !(str_starts_with($request->path(), 'ecommerce'))){
            return redirect()->route('handleDemoLogin');
        }

        return $next($request);
    }
}
