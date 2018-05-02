<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/6
 * Time: 11:32
 */

namespace App\Services;


use App\Models\User;
use App\Models\UserAuthentication;
use App\Models\Enlist;
use App\Models\AccountRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService
{
    private $User;
    private $Enlist;
    private $UserAuthentication;
    function __construct()
    {
        parent::__construct();
        $this->User = new User;
        $this->Enlist = new Enlist;
        $this->UserAuthentication = new UserAuthentication;
    }
    /**
     * 获取还款详情
     * @param $apply_id
     */
    public function getDetail($apply_id){
        $condition = [
            ["account_role.account_id",$apply_id],
        ];
        $info = $this->goWhere(DB::table("lh_role as role"),$condition)
            ->select(["role.tag"])
            ->leftJoin("lh_account_role as account_role","account_role.role_id","=","role_id")
            ->leftJoin("lh_account as account","account.id","=","account_role.account_id")
            ->first();
//        $condition = [
//            ["id",456],
//            //  ["status","!=",AssetApply::$STATUS_DELETE]
//        ];
//        $info = $this->User->where($condition)
//            ->first();
        return $info;
    }
    /**
     * 用户页面
     */
    public function getData($pageOption=[],$condition=[]){
        $p = isset($pageOption["pageNum"])&&$pageOption["pageNum"]>0?$pageOption["pageNum"]:1;
        $totalRows = $this->UserAuthentication->goWhere($condition)
            ->count("*");
        $perRows = (isset($pageOption["perRows"])&&$pageOption["perRows"]>0)?$pageOption["perRows"]:parent::$DEFAULT_PER_PAGE_ROWS;
        $pagerData = $this->makePager($totalRows,$p,$perRows);
        $res["pager"] = $pagerData["pager"];

        $res["list"] = $this->UserAuthentication->goWhere($condition)
            ->limit($pagerData["limit"]["limit"])
            ->offset($pagerData["limit"]["offset"])
            // ->whereIn("apply_id",$info->apply_id)
            ->get(); //var_dump($list);exit;
//var_dump($res);exit;
        return $res;
    }
    /**
     * 虚拟公益使者表
     */
    public function dummyLists($pageOption=[],$condition=[]){
        $p = isset($pageOption["pageNum"])&&$pageOption["pageNum"]>0?$pageOption["pageNum"]:1;
        $totalRows = $this->User->goWhere($condition)
            ->count("*");
        $perRows = (isset($pageOption["perRows"])&&$pageOption["perRows"]>0)?$pageOption["perRows"]:parent::$DEFAULT_PER_PAGE_ROWS;
        $pagerData = $this->makePager($totalRows,$p,$perRows);
        $res["pager"] = $pagerData["pager"];

        $res["list"] = $this->User->goWhere($condition)
            ->limit($pagerData["limit"]["limit"])
            ->offset($pagerData["limit"]["offset"])
            // ->whereIn("apply_id",$info->apply_id)
            ->get(); //var_dump($list);exit;
//var_dump($res);exit;
        return $res;
    }
    /**
     * 报名列表
     */
    public function enlist($pageOption=[],$condition=[]){
        $p = isset($pageOption["pageNum"])&&$pageOption["pageNum"]>0?$pageOption["pageNum"]:1;
        $totalRows = $this->Enlist->goWhere($condition)
            ->count("*");
        $perRows = (isset($pageOption["perRows"])&&$pageOption["perRows"]>0)?$pageOption["perRows"]:parent::$DEFAULT_PER_PAGE_ROWS;
        $pagerData = $this->makePager($totalRows,$p,$perRows);
        $res["pager"] = $pagerData["pager"];

        $res["list"] = $this->Enlist->goWhere($condition)
            ->limit($pagerData["limit"]["limit"])
            ->offset($pagerData["limit"]["offset"])
            // ->whereIn("apply_id",$info->apply_id)
            ->get(); //var_dump($list);exit;
//var_dump($res);exit;
        return $res;
    }
    /**
     * 根据用户名获取用户
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username){
        $field = [
            "usr_user.*","role.role_name"
        ];
        return $this->User->where("usr_user.username",$username)
            ->select($field)
            ->leftJoin("usr_role as role","role.role_id","=","usr_user.user_id")
            ->first();
    }

    //public function

    /**
     * 根据ID更新用户
     */
    public function updateUserById($user_id,$data){
        return $this->User->where("user_id",$user_id)->update($data);
    }

    /**
     * 获取当前登录用户信息
     */
    public function getLoginUserInfo(){
        if($this->userInfo){
            return $this->userInfo;
        }else{
            return null;
        }
    }

    /**
     * 创建新用户
     */
    public function createNewUser($data,$admin_user_id=-1){
        $data["password"] = passwordEncrypt($data["password"]);
        return $this->User->insertGetId($data);
    }
    /**
     * 删除申请
     */
    public function deleteApply($user_id){
        $data["status"] = User::$STATUS_DELETE;
        if($u = $this->User->where("user_id",$user_id)->update($data)){
            return $u;
        }else{
            return false;
        }
    }

}