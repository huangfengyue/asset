<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/14
 * Time: 13:21
 */

namespace App\Http\Middleware;

use App\Models\AccountRole;
use Closure;
use Illuminate\Support\Facades\Cookie;
class AssetorBasic
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
        if(preg_match('/^assetor\S*/',$request->path())){
            if($auth->role_id != AccountRole::$ROLE_ASSET){
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