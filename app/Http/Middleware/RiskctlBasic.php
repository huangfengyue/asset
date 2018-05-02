<?php

namespace App\Http\Middleware;

use App\Models\AccountRole;
use Closure;
use Illuminate\Support\Facades\Cookie;

class RiskctlBasic
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
        $auth = json_decode(Cookie::get("user_auth"));
        if(preg_match('/^riskctl\S*/',$request->path())){
            if($auth->role_id != AccountRole::$ROLE_RISKCTL){
                if($request->ajax()){
                    $data["status"] = 200;
                    $data["msg"]    = "没有权限";
                    $data["data"] = [];
                    return response()->json($data,200);
                }else{
                    return redirect("/success/?msg=没有权限&return_url=/&time=3");
                }
            }
        }else{
            return redirect("/error?msg=没有权限&return_url=/login");
        }
        return $next($request);
    }
}
