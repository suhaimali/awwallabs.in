<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClearFinanceLocks
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        
        if ($route) {
            $routeName = $route->getName();
            
            // Clear Daily Collection unlock status if navigating away
            if ($routeName !== 'daily-collection' && $routeName !== 'daily-collection.unlock') {
                $request->session()->forget('daily_collection_unlocked');
            }
            
            // Clear Income Report unlock status if navigating away
            if ($routeName !== 'income-report' && $routeName !== 'income-report.unlock') {
                $request->session()->forget('income_report_unlocked');
            }
        }

        return $next($request);
    }
}
