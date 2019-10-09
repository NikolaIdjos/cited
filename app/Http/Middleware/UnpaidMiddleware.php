<?php

namespace App\Http\Middleware;

use Closure;

class UnpaidMiddleware
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
        $subscriber = $request->route('subscriber');
        if (isset($subscriber)) {
            if ($subscriber->status == 'UNPAID') {
                abort(401);
            }
            return $next($request);
        }
    }
}
