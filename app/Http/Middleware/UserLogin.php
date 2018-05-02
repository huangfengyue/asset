<?php

namespace App\Http\Middleware;

use App\Models\AccountRole;
use Closure;
use Illuminate\Support\Facades\Cookie;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($auth = Cookie::get("user_auth")){
            $auth = json_decode($auth);
            if(!isset($auth->user_id) || $auth->user_id < 1 || !isset($auth->username) || $auth->username == ""){
                return redirect("/login");
            }
        }else{
            return redirect("/login");
        }
        $auth = json_decode(Cookie::get("user_auth"));
        if(preg_match('/^\/$/',$request->path())){
            if($auth->role_id == AccountRole::$ROLE_CHUSHEN){
                return redirect("/chushen");
            }elseif ($auth->role_id == AccountRole::$ROLE_ADMIN){
                return redirect("/admin");
            }elseif($auth->role_id == AccountRole::$ROLE_FUSHEN){
                return redirect("/fushen");
            }elseif($auth->role_id == AccountRole::$ROLE_ZHONGSHEN){
                return redirect("/zhongshen");
            }elseif($auth->role_id == AccountRole::$ROLE_AGENCY){
                return redirect("/agency");
            }elseif($auth->role_id == AccountRole::$ROLE_FIANACER){
                return redirect("/financer");
            }else{
                return redirect("/error?msg=未开放角色&return_url=/login");
            }
        }else{
            return $next($request);
        }
    }
}
