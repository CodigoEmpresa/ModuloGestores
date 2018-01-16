<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       if(!isset($_SESSION['Usuario']))
       {
           $_SESSION['Usuario'] = '';
       }
       
       if($_SESSION['Usuario'] == '')
       {
           return redirect()->to('/');
       }
       return $next($request);
    }
}
