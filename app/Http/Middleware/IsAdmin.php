<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        //dd($request->user()->admin);
        if($request->user()){
            if($request->user()->admin===1){
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
}
