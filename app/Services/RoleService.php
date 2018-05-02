<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/16
 * Time: 10:46
 */

namespace App\Services;


use App\Models\AccountRole;

class RoleService extends BaseService
{
    private $UserRole;
    public function __construct()
    {
        parent::__construct();
        $this->UserRole = new AccountRole();
    }

    /**
     * 获取角色集合
     * @return mixed
     */
    public function getRoleItem(){
        $condition = [
            ["status",1],
            ["role_id","<>",1]
        ];
        return $this->UserRole->goWhere($condition)
            ->get();
    }
}