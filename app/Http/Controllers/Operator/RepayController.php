<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 13:42
 */

namespace App\Http\Controllers\Operator;


use App\Http\Controllers\Operator\Base\BaseController;
use App\Models\AssetApply;
use App\Services\AssetService;
use App\Services\CertService;
use Illuminate\Http\Request;

class RepayController extends BaseController
{
    private $AssetService;
    private $CertService;
    public function __construct()
    {
        parent::__construct();
        $this->AssetService = new AssetService();
        $this->CertService = new CertService();
    }
    /**
     * 还款列表
     */
    public function lists(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $condition = [
                ["status","IN",[AssetApply::$STATUS_FINISH_LOAN]]
            ];
            $res = $this->AssetService->getApplyList($pageOption,5,$condition);
            foreach ($res["list"] as $k => &$v){
                $v->create_time = date("Y-m-d H:i",$v->create_time);
            }
            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
        }
    }
}