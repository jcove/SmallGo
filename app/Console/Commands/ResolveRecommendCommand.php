<?php

namespace App\Console\Commands;

use App\Common\TaoBao;
use App\Models\GoodsShare;
use App\Models\ScheduleLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ResolveRecommendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:resolve_recommend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path                                           =   config('taobao.excel_path');

        if(is_dir($path)){
            $dp = dir($path);
        }else{
            return null;
        }
        $files                                          =   array();
        while ($file = $dp ->read()){
            if($file !="." && $file !=".." && is_file($path.DIRECTORY_SEPARATOR.$file) && stripos($file,'xls')){
                $files[] = $path.DIRECTORY_SEPARATOR.$file;

            }
        }
        foreach ($files as $file){
            $md5                                            =   md5_file($file);
            $log                                            =   ScheduleLog::getByMd5($md5);
            if($log){
                Log::info('pass');

            }else{
                $this->resolve($file);
            }
            exit();
        }
    }

    protected function resolve($file){
        if(stripos($file,'xls')){

            try {
                $log = new ScheduleLog();
                $log->name = $file;
                $log->md5 = md5_file($file);
                $log->save();
                set_time_limit(300);
                ini_set("memory_limit", "512M");
                //设置以Excel5格式(Excel97-2003工作簿)
                $inputFileType = IOFactory::identify($file);
                $reader = IOFactory::createReader($inputFileType);
                $PHPExcel = $reader->load($file); // 载入excel文件
                $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                Log::info('共计'.($highestRow-1).'个商品');
                $fields = [];
                for ($i = 'A'; $i < 'ZZ'; $i++) {
                    $title = $sheet->getCell($i . '1')->getValue();
                    if (!empty($title)) {
                        switch ($title) {
                            case '商品id':
                                $fields['original_id'] = $i;
                                break;
                            case '商品名称':
                                $fields['title'] = $i;
                                break;
                            case '商品主图':
                                $fields['cover'] = $i;
                                break;
                            case '商品详情页链接地址':
                                $fields['item_url'] = $i;
                                break;
                            case '淘宝客链接':
                                $fields['click_url'] = $i;
                                break;
                            case '商品价格(单位：元)':
                                $fields['price'] = $i;
                                break;
                            case '商品月销量':
                                $fields['volume'] = $i;
                                break;
                            case '优惠券剩余量':
                                $fields['coupon_remain_count'] = $i;
                                break;
                            case '优惠券面额':
                                $fields['coupon_info'] = $i;
                                break;
                            case '优惠券开始时间':
                                $fields['coupon_start_time'] = $i;
                                break;
                            case '优惠券结束时间':
                                $fields['coupon_end_time'] = $i;
                                break;
                            case '商品优惠券推广链接':
                                $fields['coupon_click_url'] = $i;
                                break;
                            case '商品链接':
                                $fields['item_url'] = $i;
                                break;
                            case '开推时间':
                                $fields['activity_start_time'] = $i;
                                break;
                            case '推广链接':
                                $fields['click_url'] = $i;
                                break;
                            case '平台类型':
                                $fields['from_site'] = $i;
                                break;
                            default:
                                if (is_numeric($title)) {
                                    $fields['channel_id'] = $title;
                                }
                        }
                    } else {
                        break;
                    }

                }

                /** 循环读取每个单元格的数据 */
                for ($row = 2; $row <= $highestRow; $row++) {//行数是以第1行开始
                    Log::info('开始执行第'.($row-1).'条');
                    $recommendGoods = GoodsShare::getByNumIid($sheet->getCell($fields['original_id'] . $row)->getValue());
                    if (empty($recommendGoods)) {
                        $recommendGoods = new GoodsShare();
                        $recommendGoods->original_id = $sheet->getCell($fields['original_id'] . $row)->getValue();

                        $recommendGoods->name = $sheet->getCell($fields['title'] . $row)->getValue();
                        $recommendGoods->title = $sheet->getCell($fields['title'] . $row)->getValue();
                        $recommendGoods->cover = $sheet->getCell($fields['cover'] . $row)->getValue();
                        $taobao = new TaoBao();
                        $goods = $taobao->item($sheet->getCell($fields['original_id'] . $row)->getValue());
                        if ($goods) {
                            $recommendGoods->setPicturesAttribute($goods['pictures']);
                        } else {
                            $recommendGoods->pictures = '';
                        }
                        $recommendGoods->item_url = $sheet->getCell($fields['item_url'] . $row)->getValue();
                    }
                    if (isset($fields['volume'])) {
                        $recommendGoods->volume = $sheet->getCell($fields['volume'] . $row)->getValue();
                    }
                    if (isset($fields['from_site'])) {
                        $recommendGoods->from_site = $sheet->getCell($fields['from_site'] . $row)->getValue();
                    }
                    $recommendGoods->price = $sheet->getCell($fields['price'] . $row)->getValue();
                    $recommendGoods->coupon_start_time = $sheet->getCell($fields['coupon_start_time'] . $row)->getValue();
                    $recommendGoods->coupon_end_time = $sheet->getCell($fields['coupon_end_time'] . $row)->getValue();
                    $recommendGoods->coupon_remain_count = $sheet->getCell($fields['coupon_remain_count'] . $row)->getValue();
                    $recommendGoods->channel_id = $recommendGoods->channel_id ? $recommendGoods->channel_id : 1;
                    if (isset($fields['channel_id'])) {
                        $recommendGoods->channel_id = $fields['channel_id'];
                    }
                    if (isset($fields['coupon_info'])) {
                        $couponInfo = $sheet->getCell($fields['coupon_info'] . $row)->getValue();
                        if (!empty($couponInfo) && $couponInfo != '无') {
                            preg_match_all('/\d+/', $couponInfo, $matches);

                            if ($matches) {
                                if (strpos($couponInfo, '无条件')) {
                                    $recommendGoods->coupon_amount = isset($matches[0][0]) ? intval($matches[0][0]) : 0;
                                    $recommendGoods->coupon_start_fee = 0;
                                } else {
                                    $recommendGoods->coupon_amount = isset($matches[0][1]) ? intval($matches[0][1]) : 0;
                                    $recommendGoods->coupon_start_fee = isset($matches[0][0]) ? intval($matches[0][0]) : 0;
                                }

                            }
                            $recommendGoods->coupon_status = 1;
                        }

                    }

                    $clickUrl = $sheet->getCell($fields['click_url'] . $row)->getValue();
                    if (strpos($clickUrl, 'uland') > 0) {
                        $recommendGoods->coupon_click_url = $clickUrl;
                    } else {
                        $recommendGoods->click_url = $clickUrl;
                    }

                    if (isset($fields['coupon_click_url'])) {
                        $recommendGoods->coupon_click_url = $sheet->getCell($fields['coupon_click_url'] . $row)->getValue();
                        $pos = strpos($recommendGoods->coupon_click_url, '&pid');
                        if ($pos > 0) {
                            $recommendGoods->coupon_click_url = mb_strcut($recommendGoods->coupon_click_url, 0, $pos);
                        }
                    }

                    $recommendGoods->coupon_price = $recommendGoods->price - intval($recommendGoods->coupon_amount);
                    $recommendGoods->is_recommend = 1;

                    $recommendGoods->save();
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
            } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                Log::error($e->getMessage());
            }

            unlink($file);

        }



    }
}
