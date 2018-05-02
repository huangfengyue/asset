<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/5
 * Time: 10:41
 */

namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    public function index(Request $request){
        if($request->ajax()){
            $username = $request->input("username");
            $password = $request->input("password");
//            if(!regexValidate("username",$username)){
//                return $this->responseJson(0,"用户名输入有误");
//            }
            if(!regexValidate("password",$password)){
                return $this->responseJson(0,"密码输入有误");
            }
            $UserService = new UserService();
            if($user = $UserService->getUserByUsername($username)){
                if($user->status != User::$STATUS_ENABLE){
                    return $this->responseJson(0,"账户异常，无法登录");
                }elseif($user->password != passwordEncrypt($password)){
                    return $this->responseJson(0,"密码不正确");
                }else{

                    $update["last_ip"] = $user->this_ip;
                    $update["last_time"] = $user->this_time;
                    $update["this_ip"] = $request->getClientIp();
                    $update["this_time"] = time();
                    if($UserService->updateUserById($user->user_id,$update)){
                        //设置COOKIE
                        $auth["user_id"] = $user->user_id;
                        $auth["username"] = $user->username;
                        $auth["nickname"] = $user->nickname;
                        $auth["role_id"] = $user->role_id;
                        $auth["district"] = $user->district;
                        $auth["city"] = $user->city;
                        $auth["city_num"] = $user->city_num;
                        $auth["city_initials"] = $user->city_initials;
                        return $this->responseJson(200,"登陆成功")->withCookie("user_auth",json_encode($auth,JSON_UNESCAPED_UNICODE));
                    }else{
                        return $this->responseJson(0,"系统发生故障，暂时无法登录");
                    }
                }
            }else{
                return $this->responseJson(0,"用户名不存在");
            }
        }else{
            return $this->view();
        }
    }
    public function newpwd(Request $request){
        if($request->ajax()){
            $username = $request->input("username");
            $newpassword = $request->input("newpassword");
            $newpassword1 = $request->input("newpassword1");
            $password = $request->input("password");
            if($newpassword1!=$newpassword){
                return $this->responseJson(0,"新密码不一致");
            }
//            if(!regexValidate("username",$username)){
//                return $this->responseJson(0,"用户名输入有误");
//            }
            $UserService = new UserService();
            if($user = $UserService->getUserByUsername($username)){
                if($user->status != User::$STATUS_ENABLE){
                    return $this->responseJson(0,"账户异常，无法登录");
                }elseif($user->password != passwordEncrypt($password)){
                    return $this->responseJson(0,"密码不正确");
                }else{


                    $update["last_ip"] = $user->this_ip;
                    $update["last_time"] = $user->this_time;
                    $update["this_ip"] = $request->getClientIp();
                    $update["password"] = passwordEncrypt($newpassword);
                    $update["this_time"] = time();
                    if($UserService->updateUserById($user->user_id,$update)){
                        return $this->responseJson(200,"修改成功请重新登入","/login");
                    }else{
                        return $this->responseJson(0,"系统发生故障，暂时无法修改密码");
                    }
                }
            }
        }else{
            return $this->view();
        }
    }

    /**
     * 退出登录
     */
    public function loginout(Request $request){
        if($request->ajax()){
            return $this->responseJson(200,"退出成功")->withCookie(Cookie::forget("user_auth"));
        }else{
            return $this->responseJson(0,"退出方式异常");
        }
    }
}