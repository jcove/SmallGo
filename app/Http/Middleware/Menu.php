<?php

namespace App\Http\Middleware;

use Closure;

class Menu
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
        $meneModel                      =   new \App\Models\Menu();
        $menus                          =   $meneModel->getAllMenu(0);
        view()->share(['common_menus'=>$menus]);
        return $next($request);
    }
}
