<?php
/**
 * 资产面审录入表
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 18:01
 */

namespace App\Models;


class Account extends BaseModel
{
    protected $table = "lh_account";
    public $timestamps = false;
    protected $primaryKey = "id";
//状态名
    static public $STATUS_NAME_ITEM = [
        0   =>  "否",
        1   =>  "是",
        2   =>  "无app",
        3   =>  "已婚",
        4   =>  "未婚",
        5   =>  "单身",
    ];

}