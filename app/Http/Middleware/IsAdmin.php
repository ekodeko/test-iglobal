<?php

namespace App\Http\Middleware;

use App\Helpers\MyHelper;
use Closure;

class IsAdmin
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
        if ($request->user()->role == 'user') {
            MyHelper::setMessage('Nahloh', 'error', 'Sepertinya kamu mencoba mengakses halaman yang di larang');
            return redirect('home');
        }
        return $next($request);
    }
}
