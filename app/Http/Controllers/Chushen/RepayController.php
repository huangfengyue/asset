<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 13:42
 */

namespace App\Http\Controllers\Chushen;

use App\Http\Controllers\Chushen\Base\BaseController;
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
            if($times=$request->get("times")){
                $conditions = [
                    ["time",$times],
                    ["city",$this->userInfo->city],
                    ["city_num",$this->userInfo->city_num],
                    ["district",$this->userInfo->district],
                ];
            }elseif(($time1=$request->get("time1"))&&($time2=$request->get("time2"))){
                $conditions = [
                    ["time","<=",$time2],
                    ["time",">=",$time1],
                    ["city",$this->userInfo->city],
                    ["city_num",$this->userInfo->city_num],
                    ["district",$this->userInfo->district],
                ];
            } else{
                $conditions = [
                    ["time","<=",date("Y/m/d",time())],
                    ["city",$this->userInfo->city],
                    ["city_num",$this->userInfo->city_num],
                    ["district",$this->userInfo->district],
                ];
            }
            $a=array(3,9,15,16,41,42,43,45);
            if(in_array($this->userInfo->user_id,$a)||($this->userInfo->role_id==1)){
                if($times=$request->get("times")){
                    $conditions = [
                        ["time",$times],
                    ];
                }elseif(($time1=$request->get("time1"))&&($time2=$request->get("time2"))){
                    $conditions = [
                        ["time","<=",$time2],
                        ["time",">=",$time1],
                    ];
                } else{
                    $conditions = [
                        ["time","<=",date("Y/m/d",time())],
                    ];
                }
            }
            $res = $this->AssetService->getRepayList($pageOption,5,$conditions,$this->userInfo->role_id);
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
        if($times=$request->get("times")){
            $conditions = [
                ["time",$times],
            ];
        }elseif(($time1=$request->get("time1"))&&($time2=$request->get("time2"))){
            $conditions = [
                ["time","<=",$time2],
                ["time",">=",$time1],
            ];
        } else{
            $conditions = [
                ["time","<=",date("Y/m/d",time())],
            ];
        }
        $cellData = $this->AssetService->getRepayLists(5,$conditions);
        $cellDatas["w"]=array("流水号","借款人","产品类型","放款金额","总借款期数","当前期数","当前应收","当前应收服务费","逾期天数","逾期费用","当前应收总额","银行卡号","本期应收时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_real_amt"]=object2array($v["attributes"]["apply_real_amt"]);
            $cellDatas[$k]["apply_week_num"]=object2array($v["attributes"]["apply_week_num"]);
            $cellDatas[$k]["apply_week_now"]=object2array($v["attributes"]["apply_week_now"]);
            $cellDatas[$k]["apply_week_amt"]=object2array($v["attributes"]["apply_week_amt"]);
            $cellDatas[$k]["apply_week_service_amt"]=object2array($v["attributes"]["apply_week_service_amt"]);
            $cellDatas[$k]["repay_late_days"]=object2array($v["attributes"]["repay_late_days"]);
            $cellDatas[$k]["repay_late_amt"]=object2array($v["attributes"]["repay_late_amt"]);
            $cellDatas[$k]["now_amt_all"]=object2array($v["attributes"]["now_amt_all"]);
            $cellDatas[$k]["bankcard_no"]=object2array($v["attributes"]["bankcard_no"]);
            $cellDatas[$k]["time"]=object2array($v["attributes"]["time"]);
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
        }
        Excel::create('初审还款跟踪',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
}