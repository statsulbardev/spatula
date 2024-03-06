<?php

namespace App\Http\Middleware;

use App\Livewire\Antrian\Traits\Helper_Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth_Antrian
{

    use Helper_Auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->auth_antrian_check()){
            return $next($request);
        }else{
            return redirect()->route('antrian-non-admin-auth');
        }
    }
}