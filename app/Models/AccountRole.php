<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/8
 * Time: 10:08
 */

namespace App\Models;


class AccountRole extends BaseModel
{
    protected $table = "lh_account_role";
    public $timestamps = false;

    static public $ROLE_ADMIN = 1;
    static public $ROLE_CHUSHEN = 2;     //初审
    static public $ROLE_FUSHEN = 3;      //复审
    static public $ROLE_ZHONGSHEN = 4;    //终审
    static public $ROLE_FIANACER = 5;   //财务
    static public $ROLE_AGENCY = 6;   //经销


}