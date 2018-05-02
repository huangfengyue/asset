<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 10:27
 */

namespace App\Http\Controllers\Riskctl;



use App\Http\Controllers\Riskctl\Base\BaseController;
use App\Models\ApplyCert;
use App\Models\AssetApply;
use App\Models\Enlist;
use App\Services\AssetService;
use App\Services\CertService;
use App\Services\OssServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends BaseController
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
     * 资产管理首页、列表
     */
    public function lists(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $res = $this->AssetService->getApplyList($pageOption);
            foreach ($res["list"] as $k => &$v){
                $v->create_time = date("Y-m-d H:i",$v->create_time);
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
     * 一审
     */
    public function check1(Request $request,$apply_id){
        if($request->ajax()){
            $pass = strtolower($request->input("result"));   //1同意 0拒绝
            if($pass == "agree"){
                $pass = AssetApply::$STATUS_SIGN;
            }elseif ($pass == "modify"){
                $pass = AssetApply::$STATUS_RISKCTL_CK1_MODIFY;
            }else{
                $pass = AssetApply::$STATUS_RISKCTL_CHECK1_FAIL;
            }
            $remark = trim($request->input("remark"));
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                if ($applyInfo->status != AssetApply::$STATUS_WAIT_RISKCTL_CHECK1) {
                    return $this->responseJson(0, "单子状态异常不可修改");
                }
                if($this->AssetService->applyRiskctlCheck1($apply_id,$pass,$remark,$this->userInfo->user_id)){
                    return $this->responseJson(200,"保存成功");
                }else{
                    return $this->responseJson(0,"保存失败");
                }
            }else{
                return $this->responseJson(0,"申请不存在");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status != AssetApply::$STATUS_WAIT_RISKCTL_CHECK1){
                    return $this->error("单子状态异常不可修改");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }
    /**
     * 一审签约
     */
    public function sign(Request $request,$apply_id){
        if($request->ajax()){
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                if ($applyInfo->status != AssetApply::$STATUS_SIGN) {
                    return $this->responseJson(0, "单子状态异常不可修改");
                }
                if($this->AssetService->applyRiskctlSign($apply_id,$this->userInfo->user_id)){
                    return $this->responseJson(200,"签约成功");
                }else{
                    return $this->responseJson(0,"签约失败");
                }
            }else{
                return $this->responseJson(0,"申请不存在");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status != AssetApply::$STATUS_SIGN){
                    return $this->error("单子状态异常不可修改");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }
    /**
     * 二审列表
     */
    public function listByCheck2(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $res = $this->AssetService->getApplyList($pageOption,2);
            foreach ($res["list"] as $k => &$v){
                $v->create_time = date("Y-m-d H:i",$v->create_time);
            }
            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
        }
    }

    /**
     * 二审
     */
    public function check2(Request $request,$apply_id){
        if($request->ajax()){
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status != AssetApply::$STATUS_WAIT_RISKCTL_CHECK2){
                    return $this->responseJson(0,"状态异常，无法审核该单，请刷新重试");
                }else{
                    $pass = strtolower($request->input("result"));   //1同意 0拒绝
                    if($pass == "agree"){
                        $pass = AssetApply::$STATUS_WAIT_PUBLISH;
                    }elseif($pass == "modify"){
                        $pass = AssetApply::$STATUS_RISKCTL_CK2_MODIFY;
                    }else{
                        $pass = AssetApply::$STATUS_RISKCTL_CHECK2_FAIL;
                    }
                    $remark = trim($request->input("remark"));
                    if($this->AssetService->applyRiskctlCheck2($apply_id,$pass,$remark,$this->userInfo->user_id)){
                        return $this->responseJson(200,"已保存审核");
                    }else{
                        return $this->responseJson(0,"审核失败，无法提交审核");
                    }
                }
            }else{
                return $this->responseJson(0,"该单已失效");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("改单已失效");
            }
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
     * 还款跟踪列表
     */
    public function repay(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $conditions = [
                ["time","<=",date("Y/m/d",time())]
            ];
            $res = $this->AssetService->getRepayList($pageOption,1,$conditions);

            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
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
            $applyInfo["ck1_sign_time_last"]= date("Y/m/d",($applyInfo["ck1_sign_time"]+604800*($applyInfo["apply_week_num"]-1)));
            //周还款额
            $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
            //平台服务费
            $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
            //还款总额
            $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
            //dd($RepayDetail);exit;
            return $this->view()->with(["RepayDetail" => $RepayDetail,"applyInfo"=>$applyInfo]);
        }
    }
    /**
     * 导出申请列表excel
     */
    public function list_excel(Request $request){
        $cellData = $this->AssetService->getApplyLists();
        $cellDatas["w"]=array("流水号","借款人","手机号","借款金额","借款期限","银行卡号","省会城市","类型","放款金额","最初上传时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["apply_amt"]=object2array($v["attributes"]["apply_amt"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["bankcard_no"]=object2array($v["attributes"]["bankcard_no"]);
            $cellDatas[$k]["city"]=object2array($v["attributes"]["city"]);
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["create_time"]=object2array(date("Y-m-d H:i",$v["attributes"]["create_time"]));
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
        }
        Excel::create('风控申请列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
    /**
     * 导出二审列表excel
     */
    public function ck2_excel(Request $request){
        $cellData = $this->AssetService->getApplyLists(2);
        $cellDatas["w"]=array("流水号","借款人","手机号","借款金额","借款期限","银行卡号","省会城市","类型","放款金额","最初上传时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["apply_amt"]=object2array($v["attributes"]["apply_amt"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["bankcard_no"]=object2array($v["attributes"]["bankcard_no"]);
            $cellDatas[$k]["city"]=object2array($v["attributes"]["city"]);
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
            $cellDatas[$k]["create_time"]=object2array($v["attributes"]["create_time"]);
        }
        Excel::create('风控二审列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
}