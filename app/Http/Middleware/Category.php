<?php

namespace App\Http\Middleware;

use App\Models\Nav;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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

        $categories                             =   Cache::get('categories');
        if(empty($categories)){
            $categoryModel                          =   new \App\Models\Category();
            $categories                         =   $categoryModel->getAllCategory(0);

        }else{
            $categories                         =   new Collection(is_array($categories)? $categories : json_decode($categories));
        }

        $navs                                   =   Cache::get('navs');
        if(empty($navs)){
            $navs                               =   Nav::allNav(1);
            Cache::put('navs', json_encode($navs), 60*12);
        }else{
            $navs                               =   new Collection(json_decode($navs));
        }
        view()->share('categories',$categories);
        view()->share('navs',$navs);
        return $next($request);
    }
}
