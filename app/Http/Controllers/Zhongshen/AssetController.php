<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 10:27
 */

namespace App\Http\Controllers\Zhongshen;



use App\Http\Controllers\Zhongshen\Base\BaseController;
use App\Models\ApplyCert;
use App\Models\AssetApply;
use App\Models\Enlist;
use App\Services\AssetService;
use App\Services\CertService;
use App\Services\OssServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Excel;

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
            if($applier_name=$request->get("applier_name")){
                $condition = [
                    ["applier_name",$applier_name],
                ];
            }elseif($applier_idcard=$request->get("applier_idcard")){
                $condition = [
                    ["applier_idcard",$applier_idcard],
                ];
            }elseif($status=$request->get("status")){
                $condition = [
                    ["status",$status],
                ];
            }elseif($phone=$request->get("phone")){
                $condition = [
                    ["applier_mobile",$phone],
                ];
            }else{
                $condition = [];
            }
            $res = $this->AssetService->getApplyList($pageOption,1,$condition);
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
     * 聚立信报告
     */
    public function jlx(Request $request,$apply_id){
        $applyInfo = $this->AssetService->getApplyDetailById($apply_id);
        $a=file_get_contents("https://www.juxinli.com/api/access_report_data?access_token=ca3bac1583394a51910ad59585c7b77f&name=$applyInfo->applier_name&phone=$applyInfo->applier_mobile&client_secret=4a1ef3ff141642a680451bf01863a08a&idcard=$applyInfo->applier_idcard");
        $a=json_decode($a,true);
        if($a["success"]=="false"){
            return $this->error($a["note"],"/zhongshen/asset/$apply_id");
        }else{
            $token=$a["report_data"]["report"]["token"];
            header("Location:https://dev.juxinli.com/#/app/reports/4.2/".$token);
            exit;
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
     * 二审信息
     */
    public function ck2Info(Request $request,$apply_id){
        if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
            if($applyInfo->zip_auth){
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("单子异常，未能获得二审资料");
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
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){

                $pass = strtolower($request->input("result"))=="agree"?1:0;   //1同意 0拒绝
                $remark = trim($request->input("remark"));
                if($this->AssetService->applyAssetCheck1($apply_id,$pass,$remark,$this->userInfo->user_id)){
                    return $this->responseJson(200,"保存成功");
                }else{
                    return $this->responseJson(0,"保存失败");
                }


            }else{
                return $this->responseJson(0,"该单已失效");
            }

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
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
            if($applier_name=$request->get("applier_name")){
                $condition = [
                    ["applier_name",$applier_name],
                ];
            }elseif($applier_idcard=$request->get("applier_idcard")){
                $condition = [
                    ["applier_idcard",$applier_idcard],
                ];
            }elseif($status=$request->get("status")){
                $condition = [
                    ["status",$status],
                ];
            }elseif($phone=$request->get("phone")){
                $condition = [
                    ["applier_mobile",$phone],
                ];
            }elseif($apply_amt_final=$request->get("apply_amt_final")){
                $condition = [
                    ["apply_amt_final",$apply_amt_final],
                ];
            }else{
                $condition = [];
            }
            $res = $this->AssetService->getApplyList($pageOption,2,$condition);
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
                if($applyInfo->status != AssetApply::$STATUS_WAIT_ASSET_CHECK2){
                    var_dump($applyInfo->status);
                    die();
                    return $this->responseJson(0,"状态异常，无法审核该单，请刷新重试");
                }else{
                    $pass = strtolower($request->input("result"))=="agree"?1:0;   //1同意 0拒绝
                    $remark = trim($request->input("remark"));
                    if($this->AssetService->applyAssetCheck2($apply_id,$pass,$remark,$this->userInfo->user_id)){
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
     * 一审设定贷款金额
     */
    public function sign(Request $request,$apply_id){
        if($request->ajax()) {
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status != AssetApply::$STATUS_WAIT_ASSET_CHECK1){
                    return $this->responseJson(0,"状态异常，无法审核该单，请刷新重试");
                }else {
                    $apply_amt = trim($request->input("apply_amt"));
                    if ($this->AssetService->applyAssetorSign($apply_id, $apply_amt, $this->userInfo->user_id)) {
                        return $this->responseJson(200, "保存成功");
                    } else {
                        return $this->responseJson(0, "保存失败");
                    }
                }
            }else{
                return $this->responseJson(0,"该单已失效");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }
    /**
     * 修改申请
     */
    public function updateApply(Request $request,$apply_id){
        if($request->ajax()){
            //预生成模型数据
            $remark = trim($request->input("remark"));
            $pass = strtolower($request->input("result"));   //1同意 0拒绝
            if($pass == "ignore"){
                $pass = AssetApply::$STATUS_FINAL_JUDGMENT_FAIL;
            }elseif ($pass == "back"){
                $pass = AssetApply::$STATUS_RETRIAL;
            }else{
//                $pass = AssetApply::$STATUS_WAIT_GENERATE;
                $pass = AssetApply::$STATUS_WAIT_LOAD;
            }
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_FINAL_JUDGMENT])){
                    return $this->responseJson(0,"该单状态异常，无法更改信息");
                }
                if($this->AssetService->applyZhongshen($apply_id,$pass,$remark,$this->userInfo->user_id)){
                    return $this->responseJson(200,"保存成功");
                }else{
                    return $this->responseJson(0,"状态更改失败");
                }
            }else{
                return $this->responseJson(0,"申请单数据无效");
            }

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_FINAL_JUDGMENT])){
                    return $this->error("该单状态异常，无法更改信息");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }
    /**
     * 查看面审录入详情
     */
    public function face_detail(Request $request,$apply_id){
        if($request->ajax()){

        }else{
            $applyInfo = $this->AssetService->getApplyDetailById($apply_id);
            $applier_name=$applyInfo["applier_name"];
            if($applyInfo = $this->AssetService->getFaceDetailById($applier_name)){
                //  dd($applyInfo);exit;
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }

    /**
     * 还款跟踪列表
     */
    public function repay(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            if($applier_name=$request->get("applier_name")){
                $condition = [
                    ["applier_name",$applier_name],
                ];
            }elseif($applier_idcard=$request->get("applier_idcard")){
                $condition = [
                    ["applier_idcard",$applier_idcard],
                ];
            }elseif($phone=$request->get("phone")){
                $condition = [
                    ["applier_mobile",$phone],
                ];
            }elseif($apply_amt_final=$request->get("apply_amt_final")){
                $condition = [
                    ["apply_amt_final",$apply_amt_final],
                ];
            }else{
                $condition = [];
            }
            $res = $this->AssetService->getApplyList($pageOption,5,$condition);

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
     * 借款协议列表
     */
    public function details(Request $request,$apply_id){
        return $this->view()->with(["apply_id"=>$apply_id]);
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
     * 导出审件列表excel
     */
    public function list_excel(Request $request){
        if($applier_name=$request->get("applier_name")){
            $condition = [
                ["applier_name",$applier_name],
            ];
        }elseif($applier_idcard=$request->get("applier_idcard")){
            $condition = [
                ["applier_idcard",$applier_idcard],
            ];
        }elseif($status=$request->get("status")){
            $condition = [
                ["status",$status],
            ];
        }elseif($phone=$request->get("phone")){
            $condition = [
                ["applier_mobile",$phone],
            ];
        }else{
            $condition = [];
        }
        $cellData = $this->AssetService->getApplyLists(1,$condition);
        $cellDatas["w"]=array("流水号","借款人","联系方式","身份证号","借款期限","类型","最初上传时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["applier_idcard"]=object2array($v["attributes"]["applier_idcard"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["create_time"]=object2array(date("Y-m-d H:i",$v["attributes"]["create_time"]));
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
        }
        Excel::create('终审审件列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
    /**
     * 导出面签列表excel
     */
    public function ck2_excel(Request $request){
        if($applier_name=$request->get("applier_name")){
            $condition = [
                ["applier_name",$applier_name],
            ];
        }elseif($applier_idcard=$request->get("applier_idcard")){
            $condition = [
                ["applier_idcard",$applier_idcard],
            ];
        }elseif($status=$request->get("status")){
            $condition = [
                ["status",$status],
            ];
        }elseif($phone=$request->get("phone")){
            $condition = [
                ["applier_mobile",$phone],
            ];
        }elseif($apply_amt_final=$request->get("apply_amt_final")){
            $condition = [
                ["apply_amt_final",$apply_amt_final],
            ];
        }else{
            $condition = [];
        }
        $cellData = $this->AssetService->getApplyLists(2,$condition);
        $cellDatas["w"]=array("流水号","区域","城市","分部","借款人","联系方式","身份证号","借款期限","类型","放款金额","最初上传时间","状态");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["district"]=object2array($v["attributes"]["district"]);
            $cellDatas[$k]["city"]=object2array($v["attributes"]["city"]);
            $cellDatas[$k]["city_num"]=object2array($v["attributes"]["city_num"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["applier_idcard"]=object2array($v["attributes"]["applier_idcard"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["create_time"]=object2array(date("Y-m-d H:i",$v["attributes"]["create_time"]));
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);

        }
        Excel::create('终审面签列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
    /**
     * 导出还款列表excel
     */
    public function repay_excel(Request $request){
        if($applier_name=$request->get("applier_name")){
            $condition = [
                ["applier_name",$applier_name],
            ];
        }elseif($applier_idcard=$request->get("applier_idcard")){
            $condition = [
                ["applier_idcard",$applier_idcard],
            ];
        }elseif($phone=$request->get("phone")){
            $condition = [
                ["applier_mobile",$phone],
            ];
        }elseif($apply_amt_final=$request->get("apply_amt_final")){
            $condition = [
                ["apply_amt_final",$apply_amt_final],
            ];
        }else{
            $condition = [];
        }
        $cellData = $this->AssetService->getApplyLists(5,$condition);
        $cellDatas["w"]=array("流水号","区域","城市","分部","借款人","联系方式","身份证号","借款期限","类型","放款金额","放款时间");
        foreach ($cellData as $k=>$v){
            $cellDatas[$k]["apply_no"]=object2array($v["attributes"]["apply_no"]);
            $cellDatas[$k]["district"]=object2array($v["attributes"]["district"]);
            $cellDatas[$k]["city"]=object2array($v["attributes"]["city"]);
            $cellDatas[$k]["city_num"]=object2array($v["attributes"]["city_num"]);
            $cellDatas[$k]["applier_name"]=object2array($v["attributes"]["applier_name"]);
            $cellDatas[$k]["applier_mobile"]=object2array($v["attributes"]["applier_mobile"]);
            $cellDatas[$k]["applier_idcard"]=object2array($v["attributes"]["applier_idcard"]);
            $cellDatas[$k]["deadline"]=object2array($v["attributes"]["deadline"].($v["attributes"]["deadline_type"]==1?" 天":" 月"));
            $cellDatas[$k]["loan_category"]=object2array($v["attributes"]["loan_category"]);
            $cellDatas[$k]["apply_amt_final"]=object2array($v["attributes"]["apply_amt_final"]);
            $cellDatas[$k]["finish_loan_time"]=object2array(date("Y-m-d H:i",$v["attributes"]["finish_loan_time"]));
        }
        Excel::create('终审还款列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
}