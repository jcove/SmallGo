<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/3/28
 * Time: 15:41
 */

namespace App\Console\Commands;


use App\Models\GoodsShare;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * 更新券后价
 * Class AutoUpdateCouponCommand
 * @package App\Console\Commands
 */
class SetCouponPriceCommand extends Command
{
    protected $signature = 'command:set_coupon';
    protected $description = 'Auto update coupon\'s info';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::update(DB::raw("UPDATE goods_shares SET  coupon_price=price WHERE coupon_status = 0 "));
        DB::update(DB::raw("UPDATE goods_shares SET coupon_status = 0,coupon_price=price WHERE coupon_status = 1 AND coupon_end_time <'".Carbon::now()->format('Y-m-d')."'"));
        DB::update(DB::raw("UPDATE goods_shares SET coupon_price=(price-coupon_amount) WHERE coupon_status = 1 AND coupon_end_time >='".Carbon::now()->format('Y-m-d')."'"));
    }
}