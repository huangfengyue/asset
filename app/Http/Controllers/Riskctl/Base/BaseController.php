<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/14
 * Time: 17:46
 */

namespace App\Http\Controllers\Riskctl\Base;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class BaseController extends Controller
{
    protected $userInfo;
    public function __construct()
    {
        parent::__construct();
        if($auth = Cookie::get("user_auth")){
            if($auth = decrypt($auth)){
                $this->userInfo = json_decode($auth)?json_decode($auth):null;
            }
        }

    }

    //重写试图显示方法
    protected function view($template = null, $data = [], $mergeData = [])
    {
        $data["loginUserInfo"] = null;
        $data["currentRoute"] = \Request::path();
        if($auth = Cookie::get("user_auth")){
            $auth = json_decode($auth);
            if(isset($auth->user_id) && $auth->user_id > 0){
                $data["loginUserInfo"] = $auth;
            }
        }
        return parent::view($template, $data, $mergeData); // TODO: Change the autogenerated stub
    }
}