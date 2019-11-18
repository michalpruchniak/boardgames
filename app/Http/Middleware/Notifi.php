<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use View;
use App\Notifications;
class Notifi
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
      $user = Auth::id();
      $notifice = Notifications::where('user_id', $user)->orderBy('created_at', 'desc')->limit(5)->get();
      $notificeCount = Notifications::where('user_id', $user)->where('seen', 0)->count();
      View::share('notifice', $notifice);
      View::share('notificeCount', $notificeCount);
        return $next($request);
    }
}
