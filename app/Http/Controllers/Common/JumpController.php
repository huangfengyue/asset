<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/9
 * Time: 15:05
 */

namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JumpController extends Controller
{
    /**
     * @param $msg
     * @param $jumpUri
     * @param int $jumpTime
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ok(Request $request)
    {
        $data["msg"]    = $request->get("msg");
        $data["return_url"] = $request->get("return_url");
        $data["time"] = $request->get("time");
        return $this->view()->with($data);
    }

    /**
     * @param $msg
     * @param $jumpUri
     * @param int $jumpTime
     * @return $this
     */
    public function fail(Request $request){
        $data["msg"]    = $request->get("msg");
        $data["return_url"] = $request->get("return_url");
        $data["time"] = $request->get("time");
        return $this->view()->with($data);
    }
}