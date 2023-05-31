<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLevel
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
        if (!auth()->user()) {
            return redirect('/login');
        }
        else {
            if (auth()->user()->level == 0) {
                $redirect = '/admin/dashboard';
            }
            elseif (auth()->user()->level == 1) {
                $redirect = '/akademik/dashboard';
            }
            elseif (auth()->user()->level == 2) {
                $redirect = '/peminjam/dashboard';
            }
            return redirect($redirect);
        }
    }
}
