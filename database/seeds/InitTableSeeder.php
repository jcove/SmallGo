<?php

namespace Database\Seed;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Nav;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Config\ConfigModel;
use Illuminate\Database\Seeder;

class InitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Category::truncate();
        Category::insert([
            [
                'name' => '女士',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '男士',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '家居',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '饮食',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '厨具',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '母婴',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '洗护',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '电器',
                'icon' => 'iconfont icon-nvshi-chenshan',
                'parent_id' => 0,
                'order' => 1
            ],

        ]);
        Channel::truncate();
        Channel::insert([
            [
                'name' => '优选',
                'cover' => '',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '特价',
                'cover' => '',
                'parent_id' => 0,
                'order' => 1
            ],
            [
                'name' => '9.9包邮',
                'cover' => '',
                'parent_id' => 0,
                'order' => 1
            ]

        ]);
        Nav::truncate();
        Nav::insert([
            [
                'title' => '优选',
                'link' => '',
                'order' => 1,
                'client'=>'mobile',
                'icon'  =>'iconfont icon-muyin-qinju'
            ],
            [
                'title' => '特价',
                'link' => 'category/2',
                'order' => 1,
                'client'=>'mobile',
                'icon'  =>'iconfont icon-jingji'
            ],
            [
                'title' => '9.9包邮',
                'link' => 'category/3',
                'order' => 1,
                'client'=>'mobile',
                'icon'  =>'iconfont icon-quanchangbaoyou'
            ],
        ]);
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '运营管理',
                'icon' => 'fa-adn',
                'uri' => '/',
            ],
            [
                'parent_id' => 8,
                'order' => 2,
                'title' => '广告',
                'icon' => 'fa-adn',
                'uri' => 'ad',
            ],
            [
                'parent_id' => 8,
                'order' => 3,
                'title' => '分类',
                'icon' => 'fa-certificate',
                'uri' => 'category',
            ],
            [
                'parent_id' => 8,
                'order' => 4,
                'title' => '商品',
                'icon' => 'fa-product-hunt',
                'uri' => 'goods',
            ],
            [
                'parent_id' => 8,
                'order' => 5,
                'title' => '商品更新',
                'icon' => 'fa-arrow-up',
                'uri' => 'taobao/update',
            ],
            [
                'parent_id' => 8,
                'order' => 6,
                'title' => '频道',
                'icon' => 'fa-stack-exchange',
                'uri' => 'channel',
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => '系统管理',
                'icon' => 'fa-wrench',
                'uri' => '',
            ],
            [
                'parent_id' => 14,
                'order' => 0,
                'title' => '导航管理',
                'icon' => 'fa-navicon',
                'uri' => 'nav',
            ],
            [
                'parent_id' => 0,
                'order' => 9,
                'title' => '任务调度',
                'icon' => 'fa-clock-o',
                'uri' => 'scheduling',
            ],
            [
                'parent_id' => 0,
                'order' => 10,
                'title' => '文件管理',
                'icon' => 'fa-file',
                'uri' => 'media',
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => '文件上传',
                'icon' => 'fa-file',
                'uri' => 'file/aether',
            ],
            [
                'parent_id' => 9,
                'order' => 0,
                'title' => '广告位管理',
                'icon' => 'fa-hand-pointer-o',
                'uri' => 'ad/position',
            ],
            [
                'parent_id' => 9,
                'order' => 0,
                'title' => '广告管理',
                'icon' => 'fa-buysellads',
                'uri' => 'ad',
            ],
        ]);
        Permission::insert([
            [
                'name' => 'Scheduling',
                'slug' => 'ext.scheduling',
                'http_method' => '',
                'http_path' => '/scheduling*',
            ],
            [
                'name' => 'Media manager',
                'slug' => 'ext.media-manager',
                'http_method' => '',
                'http_path' => '/media*',
            ],
        ]);

    }
}
