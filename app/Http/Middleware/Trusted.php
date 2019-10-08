<?php

namespace App\Http\Middleware;

use Closure;

class Trusted
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!self::verifiedToken($request)) {
            return response()->json([
                "message"   => "unauthorized"
            ],401);
        }else{
            return $next($request);
        }
    }

    private function verifiedToken($request){
        $user = \App\Secret::WhereRaw("token = ?",[ $request->header("Authorization") ])->first();
        
        return $user;
    }

}