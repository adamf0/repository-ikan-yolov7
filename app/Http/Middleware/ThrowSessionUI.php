<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ThrowSessionUI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dataCheck = ["nama","level"];
        $sessionRegister = array_keys(Session::all());

        if( count(array_intersect($sessionRegister, $dataCheck))>0 || !is_null(Auth::user()) ){
            return $next($request);
        }
        return redirect()->route('login.index');
    }
}
