<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class EmailVerified
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

      $user =Auth::user();
      if(! $user->email_verified){
        return redirect(route('login'));
      }else{
        return redirect(route('home'));
      }
        return $next($request);
    }
}
