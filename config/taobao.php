<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午3:30
 */
return [
    'app_key'        =>  env('TAOBAO_APP_KEY',''),
    'app_secret'     =>  env('TAOBAO_APP_SECRET',''),
    'ad_zone_id'     =>  env('AD_ZONE_ID'),
    'pid'            =>  env('TAOBAO_PID'),
    "excel_path"     =>  storage_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "taobao".DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.'excel', # 上传目录的本地物理路径
];