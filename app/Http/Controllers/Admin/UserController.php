<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 17:27
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Base\BaseController;
use App\Models\User;
use App\Services\AssetService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private $UserService;
    private $AssetService;
    public function __construct()
    {
        parent::__construct();
        $this->UserService = new UserService();
        $this->AssetService = new AssetService();
    }
    public function huijiLists(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $truename ="公益使者";
                $condition = [
                    ["true_name","like",'%'.$truename.'%'],
                ];

//            $adminId = 1;//$this->adminId;
//            $res =  $this->UserService->getDetail($adminId);
//var_dump($truename);exit;
            $lists =  $this->UserService->getData($pageOption,$condition);
            return $this->responseJson(200,"ok",$lists);
        }else{
            return $this->view();
        }
    }
   //虚拟公益使者表

    public function dummyLists(Request $request)
    {
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;

            $condition = [
                ["is_huiji",2],
            ];

            $lists =  $this->UserService->dummyLists($pageOption,$condition);
            return $this->responseJson(200,"ok",$lists);
        }else{
            return $this->view();
        }
    }
    /**
     * 报名列表
     * $Author: zl
     * $Datetime: 2017-06-14
     */
    public function enlist(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;

            $condition = [

            ];

            $lists =  $this->UserService->enlist($pageOption,$condition);
            return $this->responseJson(200,"ok",$lists);
        }else{echo 25;exit;
            return $this->view();
        }
    }
    /**
     * 创建用户
     */
    public function create(Request $request){
        if($request->ajax()){
            $data["role_id"] = $request->input("role_id");
            $data["username"] = trim($request->input("username"));
           // $data["nickname"] = trim($request->input("nickname"));
            $data["password"] = "123456";
            $data["mobile"] = trim($request->input("mobile"));
            $data["district"] = trim($request->input("district"));
            $data["city"] = trim($request->input("city"));
            $data["city_num"] = trim($request->input("city_num"));
          //  $data["email"] = trim($request->input("email"))?$request->input("email"):null;
            $data["status"] = $request->input("status")==1?1:0;
            $data["reg_time"] = time();
            $data["reg_ip"] = $request->getClientIp();
            if($newId = $this->UserService->createNewUser($data)){
                return $this->responseJson(200,"创建成功");
            }else{
                return $this->responseJson(0,"创建失败");
            }
        }else{
            $RoleService = new RoleService();
            $roleItem = $RoleService->getRoleItem();
            return $this->view()->with(["roleItem"=>$roleItem]);
        }
    }
    /**
     * 用户列表
     */
    public function update(Request $request,$user_id){
        if($request->ajax()){
            $data=$_POST;
            if($result = $this->UserService->updateUserById($user_id,$data)){
                // dd($result);exit;
                return $this->responseJson(200,"ok",$result);
            }else{
                return $this->responseJson(0,"false");
            }
        }else{
            $condit = [
                ["user.status","IN",[User::$STATUS_ENABLE,User::$STATUS_DISABLE]]
            ];
            $field = ["user.*","role.role_name"];
            if($applyInfo = $this->UserService->getUserId($condit,$field,$user_id)){
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->responseJson(0,"false");
            }
        }
    }
    /**
     * 删除
     */
    public function delete(Request $request,$apply_id){
        if($request->ajax()){
            $condit = [
                ["user.status","IN",[User::$STATUS_ENABLE,User::$STATUS_DISABLE]]
            ];
            $field = ["user.*","role.role_name"];
            if($applyInfo = $this->UserService->getUserId($condit,$field,$apply_id)){
                if($applyInfo->status == 1){
                    if($this->UserService->deleteApply($apply_id)){
                        return $this->responseJson(200,"删除成功");
                    }else{
                        return $this->responseJson(0,"删除失败");
                    }
                }else{
                    return $this->responseJson(0,"无法删除");
                }
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }else{

        }
    }//
}