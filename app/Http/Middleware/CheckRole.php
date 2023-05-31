<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (auth()->user() == null) {
            return redirect('/login');
        }
        else {
            foreach ($role as $value) {
                if (auth()->user()->level == $value) {
                    return $next($request);
                }
                else {
                    abort(403, 'Anda Tidak Mempunyai Akses ke Halaman Ini');
                }
            }
        }
    }
}
