<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        try {
            $response = $next($request);

            // Log the request details
            Log::info('Request', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'parameters' => $request->all(),
            ]);

            // Log performance metrics
            $duration = microtime(true) - $startTime;
            Log::info('Performance', [
                'duration' => $duration,
                'url' => $request->fullUrl(),
            ]);

            return $response;
        } catch (\Exception $e) {
            // Log exceptions
            Log::error('Exception', [
                'message' => $e->getMessage(),
                'url' => $request->fullUrl(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Re-throw the exception
            throw $e;
        }
    }
}
