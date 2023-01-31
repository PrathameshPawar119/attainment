<?php

namespace App\Http\Middleware;

use App\Models\signup_details;
use Closure;
use Illuminate\Http\Request;

class loginRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userConnection = signup_details::where('username', session()->get('username'))->where('user_id', session()->get('user_id'))->select('user_id')->distinct()->count();
        if (session()->has('username') && session()->has('user_id') && $userConnection==1) {
            return $next($request);
        }
        else{
            return redirect('/auth/login');
        }
        // if (session()->has('username') && session()->has('user_id')) {
        //     return $next($request);
        // }
        // else{
        //     return redirect('/auth/login');
        // }
    }
}
