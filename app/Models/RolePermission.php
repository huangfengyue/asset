<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/8
 * Time: 10:46
 */

namespace App\Models;


class RolePermission extends BaseModel
{
    protected $table = "usr_role_permission as role_permiss";
    public $timestamps = false;
    protected $primaryKey = "rp_id";

    static public $STATUS_ENABLE = 1;
    static public $STATUS_DISABLED = 0;
    static public $STATUS_DELETE = 99;
}