<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('admin')->check()){
            return redirect()->route('login_form')->with('error' , 'الرجاء تسجيل الدخول  أولا');
        }
        return $next($request);
    }
}
