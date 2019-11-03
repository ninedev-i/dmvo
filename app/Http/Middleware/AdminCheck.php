<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck {
   public function handle($request, Closure $next) {
      if ($request['MY_SECRET_KEY'] === env('MY_SECRET_KEY')) {
         return $next($request);
      } else {
         return redirect('api/failAuth');
      }
   }
}
