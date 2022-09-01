<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Master
{
    public function handle(Request $request, Closure $next)
    {
        if ('benjamincrozat@me.com' !== $request->user()?->email) {
            abort(403);
        }

        return $next($request);
    }
}
