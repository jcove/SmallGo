<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/30
 * Time: 8:32
 */

namespace App\Http\Controllers;



use App\Common\TaoBao;
use App\Models\RecommendGoods;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_IOFactory;

class ExcelController extends Controller
{
    public function index(){
        $filePath ='./uploads/recommend_goods.xls';
        if (!file_exists($filePath)) {
            exit("not found 31excel5.xls.\n");
        }
        set_time_limit(90);
        ini_set("memory_limit", "1024M");
        $reader                                     =   PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
        $PHPExcel                                   =   $reader->load($filePath); // 载入excel文件
        $sheet                                      =   $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow                                 =   $sheet->getHighestRow(); // 取得总行数

        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= 2; $row++){//行数是以第1行开始
            $recommendGoods                         =   RecommendGoods::getByNumIid($sheet->getCell('A'.$row)->getValue());
            if(empty($recommendGoods)){
                $recommendGoods                     =   new RecommendGoods();
                $recommendGoods->original_id        =   $sheet->getCell('A'.$row)->getValue();

                $recommendGoods->name               =   $sheet->getCell('B'.$row)->getValue();
                $recommendGoods->title              =   $sheet->getCell('B'.$row)->getValue();
                $recommendGoods->cover              =   $sheet->getCell('C'.$row)->getValue();
                $taobao                             =   new TaoBao();
                $goods                              =   $taobao->item($sheet->getCell('A'.$row)->getValue());
                if($goods){
                    $recommendGoods->setPicturesAttribute($goods['pictures']);
                }else{
                    $recommendGoods->pictures       =   '';
                }
                $recommendGoods->item_url           =   $sheet->getCell('D'.$row)->getValue();
            }
            $recommendGoods->volume                 =   $sheet->getCell('H'.$row)->getValue();
            $recommendGoods->price                  =   $sheet->getCell('G'.$row)->getValue();
            $recommendGoods->coupon_start_time      =   $sheet->getCell('S'.$row)->getValue();
            $recommendGoods->coupon_end_time        =   $sheet->getCell('T'.$row)->getValue();
            $recommendGoods->coupon_remain_count    =   $sheet->getCell('Q'.$row)->getValue();
            preg_match_all('/\d+/', $sheet->getCell('R'.$row)->getValue(), $matches);

            if($matches){
                $recommendGoods->coupon_amount      =   $matches[0][1];
            }
            $recommendGoods->click_url              =   $sheet->getCell('F'.$row)->getValue();
            $recommendGoods->coupon_click_url       =   $sheet->getCell('V'.$row)->getValue();
            $pos                                    =   strpos($recommendGoods->coupon_click_url,'&pid');
            if($pos>0){
                $recommendGoods->coupon_click_url       =   mb_strcut($recommendGoods->coupon_click_url,0,$pos);
            }

            $recommendGoods->save();
        }
    }
}