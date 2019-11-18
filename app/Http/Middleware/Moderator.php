<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Moderator
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
      if (Auth::user() &&  (Auth::user()->moderator == 1 || Auth::user()->admin == 1)) {
         return $next($request);
      }

      Session::flash('error', 'Nie masz uprawnień do przeglądania tej strony.');
      return redirect()->back();
    }
}
