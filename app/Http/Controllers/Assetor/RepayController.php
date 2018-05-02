<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/16
 * Time: 11:42
 */

namespace App\Http\Controllers\Assetor;


use App\Http\Controllers\Assetor\Base\BaseController;
use App\Models\AssetApply;
use App\Services\AssetService;
use App\Services\CertService;
use Illuminate\Http\Request;
use Excel;

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
//            $condition = [
//                ["status","IN",[AssetApply::$STATUS_FINISH_LOAN]]
//            ];
            $res = $this->AssetService->getApplyList($pageOption,5);
            foreach ($res["list"] as $k => &$v){
                $v->create_time = date("Y-m-d H:i",$v->create_time);
            }
            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
        }
    }
    /**
     * 导出还款列表excel
     */
    public function repay_excel(Request $request){
        $cellData = $this->AssetService->getApplyLists(5);
        $cellDatas["w"]=array("流水号","借款人","手机号","借款金额","借款期限","省会城市","类型","放款金额","放款时间","还款方式");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["apply_amt"]=object2array($v["attributes"]["apply_amt"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["city"]=object2array($v["attributes"]["city"]);
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["finish_loan_time"]=object2array(date("Y-m-d H:i",$v["attributes"]["finish_loan_time"]));
            $cellDatas[$k]["repay_ways"]="等本等息";
        }
        Excel::create('资产还款列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
}