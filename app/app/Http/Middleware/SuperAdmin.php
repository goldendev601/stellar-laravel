<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\ModelsExtended\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdmin
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
        $user = auth()->user();

        if ($user) {
            if ($user->role_id == Role::Super_Admin) {
                return $next($request);
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
