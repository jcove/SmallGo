<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.debug')){
            DB::listen(function ($query) {
                $tmp = str_replace('?', '"' . '%s' . '"', $query->sql);
                $tmp = vsprintf($tmp, $query->bindings);
                $tmp = str_replace("\\", "", $tmp);
                Log::info('执行SQL:' . $tmp);
            });
        }

        Schema::defaultStringLength(191);
        if(config('site.secure')){
            \URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
