<?php
namespace Database\Seed;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Nav;
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
                'name'              =>  '女士',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '男士',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '家居',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '饮食',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '厨具',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '母婴',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '洗护',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '电器',
                'icon'          =>  'iconfont icon-nvshi-chenshan',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            
        ]);
        Channel::truncate();
        Channel::insert([
            [
                'name'              =>  '优选',
                'cover'             =>  '',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '9.9包邮',
                'cover'             =>  '',
                'parent_id'         =>  0,
                'order'             =>   1
            ],
            [
                'name'              =>  '特价',
                'cover'             =>  '',
                'parent_id'         =>  0,
                'order'             =>   1
            ]
        ]);
        Nav::truncate();
        Nav::insert([
            [
                'title'              =>  '优选',
                'link'              =>  'channel/1',
                'order'             =>   1
            ],
            [
                'title'              =>  '男士',
                'link'              =>  'category/1',
                'order'             =>   1
            ],
        ]);

    }
}
