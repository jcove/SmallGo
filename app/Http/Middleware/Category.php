<?php

namespace App\Http\Middleware;

use App\Models\Nav;
use Closure;

class Category
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
        $categoryModel                          =   new \App\Models\Category();
        //$categories                             =   cache('categories');
        if(empty($categories)){
            $categories                         =   $categoryModel->getAllCategory(0);
            cache(['categories'=>$categories],30);
        }
        $navs                                   =   Nav::allNav(1);
        view()->share('categories',$categories);
        view()->share('navs',$navs);
        return $next($request);
    }
}
