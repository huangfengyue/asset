<?php

namespace App\Http\Middleware;

use App\Models\AccountRole;
use Closure;
use Illuminate\Support\Facades\Cookie;

class FinancerBasic
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
                if((preg_match('/^financer\S*/',$request->path()))||(preg_match('/^admin\S*/',$request->path()))){
                    //  if(($auth->role_id != AccountRole::$ROLE_AGENCY)&&($auth->role_id != AccountRole::$ROLE_ADMIN)){
                    if(!in_array($auth->role_id,array(AccountRole::$ROLE_FIANACER,AccountRole::$ROLE_ADMIN))){

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
