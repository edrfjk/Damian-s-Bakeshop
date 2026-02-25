<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        if (!auth()->user()->isCustomer()) {
            abort(403, 'Unauthorized. Customer access only. Admins cannot place orders.');
        }

        return $next($request);
    }
}