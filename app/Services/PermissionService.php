<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/8
 * Time: 10:13
 */

namespace App\Services;


use App\Models\RolePermission;
use App\Models\AccountRole;

class PermissionService extends BaseService
{
    private $RolePermission;
    private $Role;
    function __construct()
    {
        parent::__construct();
       $this->RolePermission = new RolePermission();
       $this->Role = new AccountRole();
    }

    /**
     * 获取权限列表
     */
    public function getPermissList(){
        if($item = RedisService::get("usr:role_permission")){

        }else{
            //从数据库获取并刷新
            $this->getNowPermissList();
        }
    }

    /**
     * 获取当前最新权限列表
     */
    public function getNowPermissList(){
        $roleItem = $this->Role
            ->select(["role.role_id","role.role_name"])
            ->where("status",1)
            ->get();
        $roleItem = $roleItem?$roleItem->toArray():null;
        foreach ($roleItem as $k => $v){
            $pItem = $this->RolePermission
                ->select(["role_permiss.pid"])
                ->where([["role_id",$v["role_id"]],["status",RolePermission::$STATUS_ENABLE]])
                ->get();
            $roleItem[$k]["permissionItem"] = $pItem?$pItem->toArray():null;
        }

        RedisService::set("usr:role_permission",$roleItem);
        //return $item;
    }
}