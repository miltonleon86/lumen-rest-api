<?php

namespace App\Http\Middleware;

use Closure;

class MyTheresaMiddleware
{
    /**
     * If we would have a custom MyTheresa Middleware it should be implemented here.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
