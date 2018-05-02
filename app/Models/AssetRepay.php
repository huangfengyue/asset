<?php
/**
 * 资产还款表
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 18:01
 */

namespace App\Models;


class AssetRepay extends BaseModel
{
    protected $table = "ast_repay";
    public $timestamps = false;
    protected $primaryKey = "id";

    //状态名
    static public $STATUS_NAME_ITEM = [
        1   =>  "正常待还",
        2   =>  "正常已还",
        3   =>  "提前结清",
        4   =>  "逾期待还",
        5   =>  "逾期已还",
        6   =>  "尚未结清",
    ];
}