<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/26
 * Time: 下午6:29
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //获取后台左侧菜单数据
        view()->composer(
            'admin.layouts.sidebar', 'App\Http\ViewComposers\SidebarMenuComposer'
        );
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}