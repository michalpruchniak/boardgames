<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Notifications;

class notifications
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
      $notificeCount = Notifications::where('user_id', $user)->count();
      View::share('notificeCount', $notificeCount);
        return $next($request);
    }
}
