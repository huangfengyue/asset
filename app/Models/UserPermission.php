<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/8
 * Time: 10:12
 */

namespace App\Models;


class UserPermission extends BaseModel
{
    protected $table = "usr_permission as permiss";
    public $timestamps = false;

    static public $STATUS_ENABLE = 1;
    static public $STATUS_DISABLE = 0;
    static public $STATUS_DELETE = 99;

}