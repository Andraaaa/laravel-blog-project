<?php

namespace App\Http\Middleware;

use Closure;

class ProveriUloge
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
        if($request->session()->has('user')){
            $korisnik=$request->session()->get('user')[0];
            if($korisnik->naziv=='admin'){
        return $next($request);
        }
        else{
            return redirect()->back()->with('neuspeh','Nemate pravo pristupa ovoj stranici!');
        }
        }
        return redirect()->back()->with('neuspeh','Nemate pravo pristupa ovoj stranici!');
        }
}
