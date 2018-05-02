<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 14:07
 */

namespace App\Http\Controllers\Financer;


use App\Http\Controllers\Financer\Base\BaseController;
use App\Models\AssetApply;
use App\Services\AssetService;
use App\Services\CertService;
use Illuminate\Http\Request;
use Excel;
use App\Models\AssetRepay;

class AssetController extends BaseController
{
    private $AssetService;
    private $CertService;
    private $Repay;
    public function __construct()
    {
        parent::__construct();
        $this->AssetService = new AssetService();
        $this->CertService = new CertService();
        $this->Repay = new AssetRepay();
    }

    /**
     * 财务管理列表
     */
    public function lists(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            if($time=$request->get("time")){
                $condition = [
                    ["finish_loan_time",">=",strtotime($time)],
                    ["finish_loan_time","<",strtotime($time)+86400],
                ];
            }elseif(($time1=$request->get("time1"))&&($time2=$request->get("time2"))){
                $condition = [
                    ["finish_loan_time",">=",strtotime($time1)],
                    ["finish_loan_time","<",strtotime($time2)+86400],
                ];
            } elseif($applier_name=$request->get("applier_name")){
                $condition = [
                    ["applier_name",$applier_name],
                ];
            } elseif($cktime=$request->get("cktime")){
                $condition = [
                    ["ck1_sign_time",">=",strtotime($cktime)],
                    ["ck1_sign_time","<",strtotime($cktime)+86400],
                ];
            }elseif(($cktime1=$request->get("cktime1"))&&($cktime2=$request->get("cktime2"))){
                $condition = [
                    ["ck1_sign_time",">=",strtotime($cktime1)],
                    ["ck1_sign_time","<",strtotime($cktime2)+86400],
                ];
            } else{
                $condition = [
                ];
            }
//            if($this->userInfo->role_id==1){//管理员所以进件都可以查看
//                $condition = [
//                ];
//            }
            $res = $this->AssetService->getApplyList($pageOption,4,$condition,[],$this->userInfo->role_id);

            foreach ($res["list"] as $k => &$v){
                //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
                if($v->deadline_type=="2"){//月
                    $v->day=$v->deadline*30;
                }else{//天
                    $v->day=$v->deadline;
                }

                if($v->loan_category=="佰事贷"){
                    //实际放款额
                    $v->apply_real_amt=$v->apply_amt_final-round((($v->apply_amt_final+$v->apply_amt_final*$v->day*0.003)/($v->day/7)),2);
                    $v->create_time = date("Y-m-d H:i",$v->create_time);
                    //还款总额
                    $v->apply_amt_all=round($v->apply_amt_final*1.528844,2);
                }else{
                    //实际放款额
                    $v->apply_real_amt=$v->apply_amt_final;
                    $v->create_time = date("Y-m-d H:i",$v->create_time);
                    //还款总额
                    $v->apply_amt_all=$v->apply_amt_final;
                }
            }
            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
        }
    }

    /**
     * 查看资产申请详情
     */
    public function detail(Request $request,$apply_id){
        if($request->ajax()){

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
                if( $applyInfo["loan_category"]=="佰事贷"){
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                    //周还本金
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                }else{
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                    $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"];
                    $applyInfo["apply_week_amt"]=round(($applyInfo["apply_amt_all"]+$applyInfo["apply_service_amt"])/$applyInfo["apply_week_num"],2);
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
                }
                $applyInfo["apply_week_intrests"]=  $applyInfo["apply_week_amt"]- $applyInfo["apply_week_ben"];
                $applyInfo["apply_real_amt"]=$applyInfo["apply_amt_final"]- $applyInfo["apply_week_amt"];
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }

    /**
     * 证书详情
     */
    public function certDetail(Request $request,$apply_id){
        if($request->ajax()){

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                $certItem  = $this->AssetService->getApplyCertItemByApplyId($apply_id);
                $itemGroup = [];
                $CertService = new CertService();
                foreach ($certItem as $k => $v){
                    $itemGroup[$v->type_id][] = $v;
                }
                $list = [];
                foreach ($itemGroup as $k   =>  $v){
                    $list[] = [
                        "type_id"   =>  $k,
                        "type_name" => $CertService->getTypeNameByTypeId($k),
                        "item"  =>  $v,
                    ];
                }
//                var_dump($list);
//                die();
                return $this->view()->with(["applyInfo"=>$applyInfo,"certItem"=>$list]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }

    /**
     * 视频信息
     */
    public function ck2Info(Request $request,$apply_id){
        if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
            if($applyInfo->zip_auth){
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("单子异常，还能获得二审资料");
            }
        }else{
            return $this->error("改单已失效");
        }
    }
    /**
     * 更改状态为已放款
     */
    public function finishLoan(Request $request,$apply_id){
        if($request->ajax()){
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                $pass = strtolower($request->input("result"));   //1同意 0拒绝
                if($pass == "agree"){
                    $pass = AssetApply::$STATUS_FINISH_LOAN;
                }else{
                    $pass = AssetApply::$STATUS_REFUSE_LOAD;
                }

                    $remark = $request->input("remark");
                    if($this->AssetService->finishLoan($apply_id,$remark,$pass,$this->userInfo->user_id)){
                        if($pass == AssetApply::$STATUS_FINISH_LOAN) {
                            $addrepay = $this->AssetService->addrepay($applyInfo);
                        }
                        return $this->responseJson(200,"放款成功，还款列表已生成");
                    }else{
                        return $this->responseJson(0,"状态更改失败");
                    }

            }else{
                return $this->responseJson(0,"申请未找到");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
                //周还本金
                $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                $applyInfo["apply_week_intrests"]=  $applyInfo["apply_week_amt"]- $applyInfo["apply_week_ben"];
                $applyInfo["apply_real_amt"]=$applyInfo["apply_amt_final"]- $applyInfo["apply_week_amt"];
              //  dd($applyInfo["apply_week_amt"]);exit;
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }
    /**
     * 财务还款操作
     */
    public function repay(Request $request,$apply_id){
            if ($applyInfo = $this->AssetService->getRepayDetail($apply_id)) {
                return $this->view()->with(["applyInfo" => $applyInfo]);
            } else {
                return $this->error("请求方式有误", "/");
            }

    }
    /**
     * 财务还款操作
     */
    public function repays(Request $request){
        if($request->ajax()){
            $apply_week_now = strtolower($request->input("apply_week_now"));
            $apply_week_num = strtolower($request->input("apply_week_num"));
            $apply_week_amt = strtolower($request->input("apply_week_amt"));
            $status = strtolower($request->input("status"));
            $real_amt_all = strtolower($request->input("real_amt_all"));
            $id = strtolower($request->input("id"));
            $applyInfos = $this->AssetService->getRepayUpdate($id,$status,$apply_week_amt,$real_amt_all,$apply_week_num,$apply_week_now);
            return $this->responseJson(0,"操作成功");
        }else {

        }
    }
    /**
     * 财务放款详情
     */
    public function caiwu(Request $request,$apply_id){
        if($request->ajax()){

        }else {
            $RepayDetail = $this->AssetService->getRepayDetailById($apply_id);
            $applyInfo = $this->AssetService->getApplyDetailById($apply_id);
            //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
            if($applyInfo["deadline_type"]=="2"){//月
                $applyInfo["day"]=$applyInfo["deadline"]*30;
            }else{//天
                $applyInfo["day"]=$applyInfo["deadline"];
            }
            //周还期数
            $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
            $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
            //还款终止日
            $applyInfo["ck1_sign_time_last"]= date("Y/m/d",(($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400))+604800*($applyInfo["apply_week_num"]-1)));

            if( $applyInfo["loan_category"]=="佰事贷"){
                //平台服务费
                $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                //周还款额
                $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                //还款总额
                $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                //周还本金
                $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
            }else{
                $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"];
                $applyInfo["apply_week_amt"]=round(($applyInfo["apply_amt_all"]+$applyInfo["apply_service_amt"])/$applyInfo["apply_week_num"],2);
                $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
            }//dd($applyInfo["loan_category"]);exit;
            return $this->view()->with(["RepayDetail" => $RepayDetail,"applyInfo"=>$applyInfo]);
        }
    }
    /**
     * 二审列表借款协议
     */
    public function details_1(Request $request,$apply_id){
        if($request->ajax()){

        }else {
            if ($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                if( $applyInfo["loan_category"]=="佰事贷"){
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                    //周还本金
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                }else{
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                    $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"];
                    $applyInfo["apply_week_amt"]=round(($applyInfo["apply_amt_all"]+$applyInfo["apply_service_amt"])/$applyInfo["apply_week_num"],2);
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
                }
                //借款金额分割
                $applyInfo["apply_amt_all_1"]=(intval($applyInfo["apply_amt_all"]/100000)==0)?"":intval($applyInfo["apply_amt_all"]/100000);
                $applyInfo["apply_amt_all_2"]=((($applyInfo["apply_amt_all"]/10000)%10==0)&&($applyInfo["apply_amt_all_1"]==""))?"":($applyInfo["apply_amt_all"]/10000)%10;
                $applyInfo["apply_amt_all_3"]=((($applyInfo["apply_amt_all"]/1000)%10==0)&&($applyInfo["apply_amt_all_1"]=="")&&($applyInfo["apply_amt_all_2"]==""))?"":($applyInfo["apply_amt_all"]/1000)%10;
                $applyInfo["apply_amt_all_4"]=($applyInfo["apply_amt_all"]/100)%10;
                $applyInfo["apply_amt_all_5"]=($applyInfo["apply_amt_all"]/10)%10;
                $applyInfo["apply_amt_all_6"]=($applyInfo["apply_amt_all"])%10;
                $applyInfo["apply_amt_all_7"]=($applyInfo["apply_amt_all"]*10)%10;
                $applyInfo["apply_amt_all_8"]=($applyInfo["apply_amt_all"]*100)%10;
                //数字转大写
                for($i=1;$i<9;$i++) {
                    $applyInfo["apply_char_" . $i] = $this->AssetService->transBig($applyInfo["apply_amt_all_" . $i]);
                }
                $applyInfo["char"]=$this->AssetService->cny($applyInfo);
                //周偿还本息数额分割
                $applyInfo["apply_week_amt_1"]=(intval($applyInfo["apply_week_amt"]/1000)==0)?"":intval($applyInfo["apply_week_amt"]/1000);
                $applyInfo["apply_week_amt_2"]=((($applyInfo["apply_week_amt"]/100)%10==0)&&($applyInfo["apply_week_amt_1"]==""))?"":($applyInfo["apply_week_amt"]/100)%10;
                $applyInfo["apply_week_amt_3"]=((($applyInfo["apply_week_amt"]/10)%10==0)&&($applyInfo["apply_week_amt_1"]=="")&&($applyInfo["apply_week_amt_2"]==""))?"":($applyInfo["apply_week_amt"]/10)%10;
                $applyInfo["apply_week_amt_4"]=((($applyInfo["apply_week_amt"])%10==0)&&($applyInfo["apply_week_amt_1"]=="")&&($applyInfo["apply_week_amt_2"]=="")&&($applyInfo["apply_week_amt_3"]==""))?"":($applyInfo["apply_week_amt"])%10;
                $applyInfo["apply_week_amt_5"]=($applyInfo["apply_week_amt"]*10)%10;
                $applyInfo["apply_week_amt_6"]=($applyInfo["apply_week_amt"]*100)%10;
                //还款起始日
                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400)));
                //还款终止日
                $applyInfo["ck1_sign_time_last"]= date("Y/m/d",(($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400))+604800*($applyInfo["apply_week_num"]-1)));
                return $this->view()->with(["applyInfo" => $applyInfo]);
            } else {
                return $this->error("借款协议数据无效", "/asset");
            }
        }
    }
    public function details_2(Request $request,$apply_id){
        if($request->ajax()){

        }else {
            if ($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                if( $applyInfo["loan_category"]=="佰事贷"){
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                    //周还本金
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                }else{
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                    $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"];
                    $applyInfo["apply_week_amt"]=round(($applyInfo["apply_amt_all"]+$applyInfo["apply_service_amt"])/$applyInfo["apply_week_num"],2);
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
                }
                //借款金额分割
                $applyInfo["apply_amt_all_1"]=(intval($applyInfo["apply_amt_all"]/100000)==0)?"":intval($applyInfo["apply_amt_all"]/100000);
                $applyInfo["apply_amt_all_2"]=((($applyInfo["apply_amt_all"]/10000)%10==0)&&($applyInfo["apply_amt_all_1"]==""))?"":($applyInfo["apply_amt_all"]/10000)%10;
                $applyInfo["apply_amt_all_3"]=((($applyInfo["apply_amt_all"]/1000)%10==0)&&($applyInfo["apply_amt_all_1"]=="")&&($applyInfo["apply_amt_all_2"]==""))?"":($applyInfo["apply_amt_all"]/1000)%10;
                $applyInfo["apply_amt_all_4"]=($applyInfo["apply_amt_all"]/100)%10;
                $applyInfo["apply_amt_all_5"]=($applyInfo["apply_amt_all"]/10)%10;
                $applyInfo["apply_amt_all_6"]=($applyInfo["apply_amt_all"])%10;
                $applyInfo["apply_amt_all_7"]=($applyInfo["apply_amt_all"]*10)%10;
                $applyInfo["apply_amt_all_8"]=($applyInfo["apply_amt_all"]*100)%10;
                //数字转大写
                for($i=1;$i<9;$i++) {
                    $applyInfo["apply_char_" . $i] = $this->AssetService->transBig($applyInfo["apply_amt_all_" . $i]);
                }
                $applyInfo["char"] = $this->AssetService->cny($applyInfo);
                return $this->view()->with(["applyInfo" => $applyInfo]);
            } else {
                return $this->error("借款协议数据无效", "/asset");
            }
        }
    }
    public function details_3(Request $request,$apply_id){
        return $this->view()->with(["apply_id" => $apply_id]);
    }
    public function details_4(Request $request,$apply_id){
        if($request->ajax()){

        }else {
            if ($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                if( $applyInfo["loan_category"]=="佰事贷"){
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                    //周还本金
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                }else{
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                    $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"]+$applyInfo["apply_service_amt"];
                    $applyInfo["apply_week_amt"]=round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
                }

                //风控确认签约时间
                if( $applyInfo["loan_category"]=="佰事贷"){
                    $data=$applyInfo["apply_amt_all"];

                }else{
                    $data=$applyInfo["apply_amt_final"];
                }
                for($i = 0; $i<$applyInfo["apply_week_num"];$i++){
                    if($i>$applyInfo["apply_week_num"]-2){
                        $applyInfo["apply_week_bens"]=$data-$applyInfo["apply_week_ben"]*$i;
                        $applyInfo["apply_week_amts"]=$applyInfo["apply_week_amt"]-$applyInfo["apply_week_ben"]+$applyInfo["apply_week_bens"];
                        $applyInfo["apply_amt_all_firsts"]=$applyInfo["apply_week_bens"];
                        $applyInfo["apply_amt_all_lasts"]=0;

                    }else{
                        $applyInfo["apply_week_bens"]= $applyInfo["apply_week_ben"];
                        $applyInfo["apply_week_amts"]= $applyInfo["apply_week_amt"];
                        $applyInfo["apply_amt_all_firsts"]=$data-$applyInfo["apply_week_bens"]*$i;
                        $applyInfo["apply_amt_all_lasts"]=$data-($i+1)*$applyInfo["apply_week_bens"];
                    }

                    $ck1_sign_times[] = [
                        "time"  =>date("Y/m/d", (($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400)) + 604800 * $i)),
                        "apply_amt_all_first"=>$applyInfo["apply_amt_all_firsts"],
                        "apply_week_ben"=>$applyInfo["apply_week_bens"],
                        "apply_week_intreset"=>(($applyInfo["loan_category"]=="佰事贷")?$applyInfo["apply_week_amts"]:$applyInfo["apply_week_amt"])-$applyInfo["apply_week_bens"],
                        "apply_week_amt"=>($applyInfo["loan_category"]=="佰事贷")?$applyInfo["apply_week_amts"]:$applyInfo["apply_week_amt"],
                        "apply_amt_all_last"=>$applyInfo["apply_amt_all_lasts"],
                        "apply_service_amt"=>round($applyInfo["apply_service_amt"]-($applyInfo["apply_service_amt"]/$applyInfo["apply_week_num"]*($i+1)),2)
                    ];
                }

                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
                //还款终止日
                $applyInfo["ck1_sign_time_last"]= date("Y/m/d",(($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400))+604800*($applyInfo["apply_week_num"]-1)));
                return $this->view()->with(["applyInfo" => $applyInfo,"ck1_sign_times"=>$ck1_sign_times]);
            } else {
                return $this->error("借款协议数据无效", "/asset");
            }
        }
    }
    public function details_5(Request $request,$apply_id){
        if($request->ajax()){

        }else {
            if ($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
                if($applyInfo["deadline_type"]=="2"){//月
                    $applyInfo["day"]=$applyInfo["deadline"]*30;
                }else{//天
                    $applyInfo["day"]=$applyInfo["deadline"];
                }
                //周还期数
                $applyInfo["apply_week_num"]=ceil($applyInfo["day"]/7);
                if( $applyInfo["loan_category"]=="佰事贷"){
                    //平台服务费
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                    //周还款额
                    $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                    //还款总额
                    $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                    //周还本金
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
                }else{
                    $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.02*7,2);
                    $applyInfo["apply_amt_all"]=$applyInfo["apply_amt_final"];
                    $applyInfo["apply_week_amt"]=round(($applyInfo["apply_amt_all"]+$applyInfo["apply_service_amt"])/$applyInfo["apply_week_num"],2);
                    $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_final"]/$applyInfo["apply_week_num"],2);
                }
                //服务费分割
                $applyInfo["apply_service_amt_1"]=(intval($applyInfo["apply_service_amt"]/100000)==0)?"":intval($applyInfo["apply_service_amt"]/100000);
                $applyInfo["apply_service_amt_2"]=((($applyInfo["apply_service_amt"]/10000)%10==0)&&($applyInfo["apply_service_amt_1"]==""))?"":($applyInfo["apply_service_amt"]/10000)%10;
                $applyInfo["apply_service_amt_3"]=((($applyInfo["apply_service_amt"]/1000)%10==0)&&($applyInfo["apply_service_amt_1"]=="")&&($applyInfo["apply_service_amt_2"]==""))?"":($applyInfo["apply_service_amt"]/1000)%10;
                $applyInfo["apply_service_amt_4"]=($applyInfo["apply_service_amt"]/100)%10;
                $applyInfo["apply_service_amt_5"]=($applyInfo["apply_service_amt"]/10)%10;
                $applyInfo["apply_service_amt_6"]=($applyInfo["apply_service_amt"])%10;
                $applyInfo["apply_service_amt_7"]=($applyInfo["apply_service_amt"]*10)%10;
                $applyInfo["apply_service_amt_8"]=($applyInfo["apply_service_amt"]*100)%10;
                //借款金额分割
                $applyInfo["apply_amt_all_1"]=(intval($applyInfo["apply_amt_all"]/100000)==0)?"":intval($applyInfo["apply_amt_all"]/100000);
                $applyInfo["apply_amt_all_2"]=((($applyInfo["apply_amt_all"]/10000)%10==0)&&($applyInfo["apply_amt_all_1"]==""))?"":($applyInfo["apply_amt_all"]/10000)%10;
                $applyInfo["apply_amt_all_3"]=((($applyInfo["apply_amt_all"]/1000)%10==0)&&($applyInfo["apply_amt_all_1"]=="")&&($applyInfo["apply_amt_all_2"]==""))?"":($applyInfo["apply_amt_all"]/1000)%10;
                $applyInfo["apply_amt_all_4"]=($applyInfo["apply_amt_all"]/100)%10;
                $applyInfo["apply_amt_all_5"]=($applyInfo["apply_amt_all"]/10)%10;
                $applyInfo["apply_amt_all_6"]=($applyInfo["apply_amt_all"])%10;
                $applyInfo["apply_amt_all_7"]=($applyInfo["apply_amt_all"]*10)%10;
                $applyInfo["apply_amt_all_8"]=($applyInfo["apply_amt_all"]*100)%10;
                //数字转大写
                for($i=1;$i<9;$i++){
                    $applyInfo["apply_char_".$i]=$this->AssetService->transBig($applyInfo["apply_amt_all_".$i]);
                }
                for($i=1;$i<9;$i++){
                    $applyInfo["apply_chars_".$i]=$this->AssetService->transBig($applyInfo["apply_service_amt_".$i]);
                }
                $applyInfo["char"] = $this->AssetService->cny($applyInfo);
                $applyInfo["service"] = $this->AssetService->cnys($applyInfo);
                //还款起始日
                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
                $applyInfo["ck1_sign_time_firsts"]=explode("/",$applyInfo["ck1_sign_time_first"]);
                return $this->view()->with(["applyInfo" => $applyInfo]);
            } else {
                return $this->error("借款协议数据无效", "/asset");
            }
        }
    }
    /**
     * 借款协议列表
     */
    public function details(Request $request,$apply_id){
        return $this->view()->with(["apply_id"=>$apply_id]);
    }
    /**
     * 导出申请列表excel
     */
    public function list_excel(Request $request){
        if($time=$request->get("time")){
            $condition = [
                ["finish_loan_time",">=",strtotime($time)],
                ["finish_loan_time","<",strtotime($time)+86400],
            ];
        }elseif(($time1=$request->get("time1"))&&($time2=$request->get("time2"))){
            $condition = [
                ["finish_loan_time",">=",strtotime($time1)],
                ["finish_loan_time","<",strtotime($time2)+86400],
            ];
        }elseif($cktime=$request->get("cktime")){
            $condition = [
                ["ck1_sign_time",">=",strtotime($cktime)],
                ["ck1_sign_time","<",strtotime($cktime)+86400],
            ];
        }elseif(($cktime1=$request->get("cktime1"))&&($cktime2=$request->get("cktime2"))){
            $condition = [
                ["ck1_sign_time",">=",strtotime($cktime1)],
                ["ck1_sign_time","<",strtotime($cktime2)+86400],
            ];
        }elseif($applier_name=$request->get("applier_name")){
            $condition = [
                ["applier_name",$applier_name],
            ];
        }  else{
            $condition = [
            ];
        }//dd($condition)
        $cellData = $this->AssetService->getApplyLists(4,$condition);
        foreach ($cellData as $k => &$v){
            //周偿还本息数额（借款金额+借款金额*借款期限*0.3%）/借款期限
            if($v->deadline_type=="2"){//月
                $v->day=$v->deadline*30;
            }else{//天
                $v->day=$v->deadline;
            }
            //实际放款额
            $v->apply_real_amt=$v->apply_amt_final-round((($v->apply_amt_final+$v->apply_amt_final*$v->day*0.003)/($v->day/7)),2);
            $v->finish_loan_time = date("Y-m-d H:i",$v->finish_loan_time);
            //还款总额
            $v->apply_amt_all=round($v->apply_amt_final*1.528844,2);
        }
        $cellDatas["w"]=array("流水号","借款人","手机号","借款合同金额","放款金额","实际放款金额","银行卡号","放款时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["apply_amt_all"]=object2array($v["attributes"]["apply_amt_all"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["apply_real_amt"]=object2array($v["attributes"]["apply_real_amt"]);
            $cellDatas[$k]["bankcard_no"]=object2array($v["attributes"]["bankcard_no"]);
            $cellDatas[$k]["finish_loan_time"]=object2array($v["attributes"]["finish_loan_time"]);
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
        }
        Excel::create('财务放款列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }

}