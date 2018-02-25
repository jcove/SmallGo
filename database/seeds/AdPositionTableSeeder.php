<?php
use App\Models\AdPosition;
use Illuminate\Database\Seeder;

class AdPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdPosition::truncate();
        AdPosition::insert([
            [
                'name' => '手机_首页_左侧广告位',
                'position' => 'mobile_index_left',
                'description' => '手机首页幻灯片下广告位，左侧大图',
            ],
            [
                'name' => '手机_首页_右侧顶部广告位',
                'position' => 'mobile_index_right_top',
                'description' => '手机首页幻灯片下，右侧上方小图',
            ],[
                'name' => '手机_首页_右侧底部广告位',
                'position' => 'mobile_index_right_bottom',
                'description' => '手机首页幻灯片下，右侧下方小图',
            ],[
                'name' => 'PC_首页_幻灯片',
                'position' => 'pc_index_swiper',
                'description' => 'PC首页的幻灯片',
            ],[
                'name' => '手机_首页_幻灯片',
                'position' => 'mobile_index_swiper',
                'description' => '手机首页的幻灯片',
            ],

        ]);
    }
}
