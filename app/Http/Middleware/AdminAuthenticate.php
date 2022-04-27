<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // if ((auth('admin')->check()) && (auth('admin')->user()->is_super_admin == 1)) {
        if (auth('admin')->check()) {
            return $next($request);
        }
        return redirect('login'); # admin login form
    }
}
