<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureNicknameSet
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
        if (!$request->session()->has('nickname')){
            return redirect('/user/setname');
        }

        $request->setUserResolver(function() {
            return ['name' => 'I am a user'];
        });

        return $next($request);
    }
}
