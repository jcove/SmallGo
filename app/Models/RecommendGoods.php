<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/27
 * Time: 上午8:53
 */

namespace App\Models;


use App\Searchable;
use Carbon\Carbon;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use GenPwdIsvParamDto;
use Illuminate\Database\Eloquent\Model;

use TbkTpwdCreateRequest;
use TopClient;
use WirelessShareTpwdCreateRequest;

class RecommendGoods extends GoodsShare
{

}