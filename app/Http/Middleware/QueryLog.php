<?php

namespace App\Http\Middleware;

use Closure;
use DB;


class QueryLog {

  /**
   * Handle an incoming request
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   *
   * @return mixed
   */

  public function handle($request, Closure $next){

    if (config('app.debug') == 'local') DB::enableQueryLog();

    return $next($request);
  }

}
