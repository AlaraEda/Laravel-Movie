<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

//php artisan make:middelware IsAdmin
//Je Middleware staat in je Kernel.php

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)         //Krijgt Request binnen & de volgende stap binnen
    {
        if(Auth::user() && Auth::user()->admin == 1){       //Ben je ingelogd & is de account waarmee je bent ingelogd een admin-account
            return $next($request);                         //Returnt de volgende stap plus de request
        }

        return redirect('/');                               //Anders, redirect naar de home-page
    }
}
