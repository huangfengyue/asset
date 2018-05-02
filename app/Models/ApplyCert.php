<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/9
 * Time: 17:13
 */

namespace App\Models;


class ApplyCert extends BaseModel
{
    protected $table = "ast_apply_cert";
    public $timestamps = false;
    protected $primaryKey = "cert_id";

    static public $STATUS_ENABLE = 1;
    static public $STATUS_DISABLE = 0;
    static public $STATUS_DELETE = 99;

}