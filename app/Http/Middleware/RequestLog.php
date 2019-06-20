<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestLog
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
        Log::info('请求：' . $request->path());
        Log::info('请求IP：' . $request->ip());
        Log::info('请求数据：' . json_encode($request->toArray()));
        return $next($request);
    }
}
