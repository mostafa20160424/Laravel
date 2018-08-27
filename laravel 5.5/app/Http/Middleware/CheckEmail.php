<?php
//to create middlewarew write in terminal (php artisan make:middleware middlewareName)
namespace App\Http\Middleware;

use Closure;

class CheckEmail
{

    public function handle($request, Closure $next,$email)
    {
    
        if(request()->has('email'))
        {
            if(request('email')==$email)
            {
                return redirect('success');//redirect('link that you se in route')
            }
            else
            {
                return redirect('cannot');
            }
        }

        return $next($request);
    }
}
