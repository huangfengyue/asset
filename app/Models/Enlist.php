<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/9
 * Time: 16:59
 */

namespace App\Models;


class Enlist extends BaseModel
{
    protected $table = "lh_enlist";
    public $timestamps = false;
    public $primaryKey = "id";

    //状态
    static public $STATUS_ENABLE = 1;
    static public $STATUS_DISABLE = 0;
    static public $STATUS_DELETE = 99;
}