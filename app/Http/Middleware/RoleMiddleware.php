<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

     /**
      * Handle an incoming request.
      *
      * @param Closure(Request): (Response) $next
      */
     public function handle($request, Closure $next, ...$vars)
     {

          if(auth()->user() && in_array(auth()->user()->role->value, $vars))
          {
               return $next($request);
          }
          return redirect()->route('front.home');
     }

}
