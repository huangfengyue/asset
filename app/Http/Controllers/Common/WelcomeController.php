<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/14
 * Time: 15:06
 */

namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use App\Models\AccountRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class WelcomeController extends Controller
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
    /**
     * 首页
     */
    public function index(Request $request){
        if($this->userInfo->role_id == AccountRole::$ROLE_CHUSHEN){
            return redirect("/chushen");
        }elseif ($this->userInfo->role_id == AccountRole::$ROLE_FUSHEN){
            return redirect("/fushen");
        }elseif ($this->userInfo->role_id == AccountRole::$ROLE_AGENCY){
            return redirect("/agency");
        }elseif ($this->userInfo->role_id == AccountRole::$ROLE_ADMIN){
            return redirect("/admin");
        }elseif($this->userInfo->role_id == AccountRole::$ROLE_ASSET){
            return redirect("/assetor");
        }elseif($this->userInfo->role_id == AccountRole::$ROLE_RISKCTL){
            return redirect("/riskctl");
        }elseif($this->userInfo->user_id == AccountRole::$ROLE_OPERATOR){
            return redirect("/operator");
        }elseif($this->userInfo->user_id == AccountRole::$ROLE_FIANACER){
            return redirect("/financer");
        }else{
            return $this->error("非法请求，请重新登陆","/login");
        }
    }
}