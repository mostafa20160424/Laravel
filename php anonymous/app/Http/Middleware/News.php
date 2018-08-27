<?php

namespace App\Http\Middleware;

use Closure;

class News
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role=null)
    {
        if(!auth()->user()){//if not login can put if(!auth()->check())
          return redirect('manual/login');
        }
        return $next($request);
        //seond step register the middleware in kernel.php in $routeMiddleware array
    }
}
