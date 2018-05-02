<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/6
 * Time: 11:30
 */

namespace App\Models;


class Image extends BaseModel
{
    public $timestamps = false;
    protected $table = "lh_image";
    protected $primaryKey = "id";

    static public $STATUS_ENABLE = 1;
    static public $STATUS_DISABLE = 0;
    static public $STATUS_DELETE = 99;

    static public $STATUS_NAME_ITEM = [
        1   =>  "正常",
        0   =>  "锁定",
        99  =>  "已删除",
    ];

}