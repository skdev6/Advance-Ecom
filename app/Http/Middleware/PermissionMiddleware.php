<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class PermissionMiddleware
{ 
    // use \App\Traite\AdminPermission;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty(auth()->user()->role->peression['permisson']['brand']['add']) && \Route::is('admin.brand')){
            return response()->view('admin.home');
        }
        return $next($request);
    }
}
