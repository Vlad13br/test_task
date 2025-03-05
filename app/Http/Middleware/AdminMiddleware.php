<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Gate::allows('access-admin')) {
            return redirect('/')->with('error', 'У вас немає доступу.');
        }

        return $next($request);
    }
}
