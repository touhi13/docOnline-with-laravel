<?php

namespace App\Http\Middleware;

use Closure;

class CheckDoctorStatus
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
        if (auth()->check() && auth()->user()->is_doctor) {
            return $next($request);
        }

        return redirect('doctor/registration/status');
    }
}