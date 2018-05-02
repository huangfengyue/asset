<?php
/**
 * 资产相关服务
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 18:03
 */

namespace App\Services;




use App\Models\ApplyCert;
use App\Models\ApplyLog;
use App\Models\AssetApply;
use App\Models\AssetRepay;
use App\Models\Account;
use Illuminate\Http\Request;

class AssetService extends BaseService
{

    private $ApplyLog;
    private $Repay;
    private $Apply;
    private $Account;
    public function __construct()
    {
        parent::__construct();
        $this->Apply = new AssetApply();
        $this->Account = new Account();
        $this->Repay = new AssetRepay();
        $this->ApplyLog = new ApplyLog();
    }
    public function getAccount($condition=[]){
        $statusIn = [
            191,190
        ];
      //  $info = $this->Account->goWhere($condition)->first();
        $info = $this->Account->whereIn("id",$statusIn)
            ->get();
        return $info;
    }


    public function getRowById
    ($condition=[]){
        $statusIn = [
            191,190
        ];
        //  $info = $this->Account->goWhere($condition)->first();
        $info = $this->Account->whereIn("id",$statusIn)
            ->get();
        return $info;
    }
    /**
     * 获取一审申请列表
     * @param int $p
     */
    public function getApplyList($pageOption=[],$type=1,$condition=[],$status=[],$role_id=[]){
        $p = isset($pageOption["pageNum"])&&$pageOption["pageNum"]>0?$pageOption["pageNum"]:1;
        if($type == 1){ //进件列表
            $statusIn = [AssetApply::$STATUS_WAIT_FIRST_TRIAL,AssetApply::$STATUS_FIRST_TRIAL_FAIL,
                AssetApply::$STATUS_RETRIAL, AssetApply::$STATUS_RETRIAL_FAIL,
                AssetApply::$STATUS_WAIT_FINAL_JUDGMENT , AssetApply::$STATUS_FINAL_JUDGMENT_FAIL,AssetApply::$STATUS_MODIFY];
        }elseif($type == 2){      //面签列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_GENERATE,AssetApply::$STATUS_WAIT_UPLOAD,
                AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_TRAIL_FAIL
            ];
        }elseif($type == 3){    //初审列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_PUBLISH,AssetApply::$STATUS_FULL,AssetApply::$STATUS_WAIT_FULL
            ];
        }elseif($type == 4){    //财务看到的申请列表
            $statusIn = [
               AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY,AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_REFUSE_LOAD
            ];
        }elseif($type == 5){    //还款列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY
            ];
        }else{
            return false;
        }
        $totalRows = $this->Apply->goWhere($condition)->whereIn("status",$statusIn)
            ->count("*");
        $perRows = (isset($pageOption["perRows"])&&$pageOption["perRows"]>0)?$pageOption["perRows"]:parent::$DEFAULT_PER_PAGE_ROWS;
        $pagerData = $this->makePager($totalRows,$p,$perRows);
        $res["pager"] = $pagerData["pager"];
        $res["list"] =  $this->Apply->goWhere($condition)
            ->whereIn("status",$statusIn)
            ->limit($pagerData["limit"]["limit"])
            ->offset($pagerData["limit"]["offset"])
            ->orderBy("apply_id","desc")
            ->get();
        //dd($condition,$res["list"]);exit;
        foreach ($res["list"] as $k => $v){
            $res["list"][$k]["status_name"] = AssetApply::$STATUS_NAME_ITEM[$v->status];
            $res["list"][$k]["finish_loan_time"] = $v->finish_loan_time?date("Y-m-d H:i",$v->finish_loan_time):null;
            $res["list"][$k]["role_id"]=$role_id;
        }
        if(!empty($status)){//dd($status);exit;
            $res["count"] = $this->Apply->whereIn("status",$status)->count();
        }

        return $res;
    }
    public function getApplyLists($type=1,$condition=[]){
        if($type == 1){ //进件列表
            $statusIn = [AssetApply::$STATUS_WAIT_FIRST_TRIAL,AssetApply::$STATUS_FIRST_TRIAL_FAIL,
                AssetApply::$STATUS_RETRIAL, AssetApply::$STATUS_RETRIAL_FAIL,
                AssetApply::$STATUS_WAIT_FINAL_JUDGMENT , AssetApply::$STATUS_FINAL_JUDGMENT_FAIL,AssetApply::$STATUS_MODIFY];
        }elseif($type == 2){      //面签列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_GENERATE,AssetApply::$STATUS_WAIT_UPLOAD,
                AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_TRAIL_FAIL
            ];
        }elseif($type == 3){    //初审列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_PUBLISH,AssetApply::$STATUS_FULL,AssetApply::$STATUS_WAIT_FULL
            ];
        }elseif($type == 4){    //财务看到的申请列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY,AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_REFUSE_LOAD
            ];
        }elseif($type == 5){    //还款列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY
            ];
        }else{
            return false;
        }
        $info = $this->Apply->where($condition)->whereIn("status",$statusIn)
            ->get();
        foreach ($info as $k => $v){
            $info[$k]["status_name"] = AssetApply::$STATUS_NAME_ITEM[$v->status];
        }//dd($condition);exit;
        return $info;

    }
    /**
     * 获取还款管理列表
     * @param int $p
     */
    public function getRepayList($pageOption=[],$type=1,$condition=[],$role_id=[]){
        $p = isset($pageOption["pageNum"])&&$pageOption["pageNum"]>0?$pageOption["pageNum"]:1;
        if($type == 1){ //进件列表
            $statusIn = [AssetApply::$STATUS_WAIT_FIRST_TRIAL,AssetApply::$STATUS_FIRST_TRIAL_FAIL,
                AssetApply::$STATUS_RETRIAL, AssetApply::$STATUS_RETRIAL_FAIL,
                AssetApply::$STATUS_WAIT_FINAL_JUDGMENT , AssetApply::$STATUS_FINAL_JUDGMENT_FAIL,AssetApply::$STATUS_MODIFY];
        }elseif($type == 2){      //面签列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_GENERATE,AssetApply::$STATUS_WAIT_UPLOAD,
                AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_TRAIL_FAIL
            ];
        }elseif($type == 3){    //初审列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_PUBLISH,AssetApply::$STATUS_FULL,AssetApply::$STATUS_WAIT_FULL
            ];
        }elseif($type == 4){    //财务看到的申请列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY,AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_REFUSE_LOAD
            ];
        }elseif($type == 5){    //还款列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY
            ];
        }else{
            return false;
        }
        $totalRows = $this->Repay->goWhere($condition)
           // ->whereIn("apply_id",$info->apply_id)
            ->count("*");
        $perRows = (isset($pageOption["perRows"])&&$pageOption["perRows"]>0)?$pageOption["perRows"]:parent::$DEFAULT_PER_PAGE_ROWS;
        $pagerData = $this->makePager($totalRows,$p,$perRows);
        $res["pager"] = $pagerData["pager"];
        $res["list"] =  $this->Repay->goWhere($condition)
          // ->whereIn("apply_id",$info->apply_id)
            ->limit($pagerData["limit"]["limit"])
            ->offset($pagerData["limit"]["offset"])
            ->orderBy("time","desc")
            ->get();

        foreach ($res["list"] as $k => $v){
            $res["list"][$k]["status_name"] = AssetRepay::$STATUS_NAME_ITEM[$v->status];
            $res["list"][$k]["apply_amt_all"]=round($v["apply_real_amt"]*1.528844,2);
            $res["list"][$k]["role_id"]=$role_id;
            $con = [
                ["apply_no",$v->apply_no],
                // ["status","!=",AssetApply::$STATUS_DELETE]
            ];
            $info = $this->Apply->where($con)
                ->first();
            $res["list"][$k]["district"]=$info->district;
            $res["list"][$k]["city"]=$info->city;
            $res["list"][$k]["city_num"]=$info->city_num;
          //  dd($info->district);exit;
        }
        return $res;
    }

    public function getRepayLists($type=1,$condition=[]){
        if($type == 1){ //进件列表
            $statusIn = [AssetApply::$STATUS_WAIT_FIRST_TRIAL,AssetApply::$STATUS_FIRST_TRIAL_FAIL,
                AssetApply::$STATUS_RETRIAL, AssetApply::$STATUS_RETRIAL_FAIL,
                AssetApply::$STATUS_WAIT_FINAL_JUDGMENT , AssetApply::$STATUS_FINAL_JUDGMENT_FAIL,AssetApply::$STATUS_MODIFY];
        }elseif($type == 2){      //面签列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_GENERATE,AssetApply::$STATUS_WAIT_UPLOAD,
                AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_TRAIL_FAIL
            ];
        }elseif($type == 3){    //初审列表
            $statusIn = [
                AssetApply::$STATUS_WAIT_PUBLISH,AssetApply::$STATUS_FULL,AssetApply::$STATUS_WAIT_FULL
            ];
        }elseif($type == 4){    //财务看到的申请列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY,AssetApply::$STATUS_WAIT_LOAD,AssetApply::$STATUS_REFUSE_LOAD
            ];
        }elseif($type == 5){    //还款列表
            $statusIn = [
                AssetApply::$STATUS_FINISH_LOAN,AssetApply::$STATUS_FINISH_REPAY
            ];
        }else{
            return false;
        }
        $info = $this->Repay->where($condition)
            ->get();
        foreach ($info as $k => $v){
          //  $info->status_name = AssetRepay::$STATUS_NAME_ITEM[$v->status];
            $info[$k]["status_name"] = AssetRepay::$STATUS_NAME_ITEM[$v->status];
        }
        return $info;
    }
    public function updateRepayLists($condition=[]){
        $info = $this->Repay->where($condition)
            ->get();
        foreach ($info as $k => $v){
            $info[$k]["apply_amt_all"]=round($v["apply_real_amt"]*1.528844,2);

            if(($v["status"]!=3)&&($v["status"]!=5)&&($v["status"]!=2)){
                if($info[$k]["apply_week_now"]==1){
                    $data["repay_late_days"]=0;
                    $data["repay_late_amt"]=0;
                    $data["real_amt_all"]=$v["apply_week_amt"];
                    $data["now_amt_all"]=$v["apply_week_amt"];
                    $data["status"]=2;
                }else{
                    $info[$k]["repay_late_days"]=floor((time()-strtotime($v["time"]))/86400)>0?floor((time()-strtotime($v["time"]))/86400):0;
                    $data["repay_late_days"]=$info[$k]["repay_late_days"];
                    $info[$k]["apply_amt_all"]=round($v["apply_real_amt"]*1.528844,2);
                    $info[$k]["repay_late_amt"]=round($info[$k]["apply_amt_all"]*0.001*$info[$k]["repay_late_days"],2);
                    $data["repay_late_amt"]=$info[$k]["repay_late_amt"];
                    $data["now_amt_all"]=$v["apply_week_amt"]+ $data["repay_late_amt"];
                    $data["real_amt_all"]=NULL;
                }

                if(($data["repay_late_days"]>0)&&($v["status"]==1)){
                    $data["status"]=4;
                }
                $u = $this->Repay->where("id",$v["id"])->update($data);
                $info[$k]["status_name"] = AssetRepay::$STATUS_NAME_ITEM[$v["status"]];
            }
        }
        return $info;
    }
    /**

     * 创建新的申请
     */
    public function createNew($data,$user_id,$city,$district,$city_initials,$city_num)
    {

        $condition = [
            ["applier_idcard",$data["applier_idcard"]],
        ];
        $info = $this->Apply->where($condition)
            ->count();
        if($info>0){
            $data["flag"] = 1;
        }
        $condition1 = [
            ["relative_phone",$data["relative_phone"]],
        ];
        $info1 = $this->Apply->where($condition1)
            ->count();
        if($info1>0){
            $data["flag1"] = 1;
        }
        if(!empty($data["relative_phone1"])){
            $condition2 = [
                ["relative_phone1",$data["relative_phone1"]],
            ];
            $info2 = $this->Apply->where($condition2)
                ->count();
            if($info2>0){
                $data["flag2"] = 1;
            }
        }
        $condition3 = [
            ["emergency_phone",$data["emergency_phone"]],
        ];
        $info3 = $this->Apply->where($condition3)
            ->count();
        if($info3>0){
            $data["flag3"] = 1;
        }
        $condition4 = [
            ["colleague_phone",$data["colleague_phone"]],
        ];
        $info4 = $this->Apply->where($condition4)
            ->count();
        if($info4>0){
            $data["flag4"] = 1;
        }
        $data["repay_type"] = AssetApply::$REPAY_TYPE_DBDX;
        $data["create_time"] = time();
        $data["user_id"] = $user_id;
        $data["city"] = $city;
        $data["district"] = $district;
        $data["city_initials"] = $city_initials;
        $data["city_num"] = $city_num;
        $data["applier_name"]=trim($data["applier_name"]);
        $data["face_trail_id"] = intval($data["face_trail_id"]);
        $data["apply_no"] = date("ymd", time()) . $user_id . rand(100000, 999999);
        $num = $this->Apply->where('apply_no', 'like', date("ymd", time()).'%')
            ->count();
        if($data["loan_category"]=="街边贷"){
            $data["borrow_nid"] = "JBD".$data["city_initials"].$city_num.date("Ymd", time()).str_pad($num+1,6,"0",STR_PAD_LEFT);
        }else{
            $data["borrow_nid"] = $district.$data["city_initials"].$city_num.date("Ymd", time()).str_pad($num+1,6,"0",STR_PAD_LEFT);
        }
        $data["status"] = AssetApply::$STATUS_WAIT_FIRST_TRIAL;
        return $this->Apply->insertGetId($data);
    }
    /**
     * 创建新的面审录入
     */
    public function create_Face_trial($data,$user_id)
    {

        $data["user_id"] = $user_id;
        $data["create_time"] = time();
        return $this->Face_trial->insertGetId($data);
    }
    /**
     * 添加财务还款列表
     */
    public function addRepay($applyInfo){
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
                    $datas=$applyInfo["apply_amt_all"];

                }else{
                    $datas=$applyInfo["apply_amt_final"];
                }
                $data["apply_no"]=$applyInfo["apply_no"];
                $data["apply_id"]=$applyInfo["apply_id"];
                $data["applier_name"]=$applyInfo["applier_name"];
                $data["loan_category"]=$applyInfo["loan_category"];
                $data["apply_real_amt"]=$applyInfo["apply_amt_final"];
                $data["apply_week_num"]=$applyInfo["apply_week_num"];
                $data["bankcard_no"]=$applyInfo["bankcard_no"];
                $data["apply_week_service_amt"]=$applyInfo["apply_service_amt"]/$applyInfo["apply_week_num"];
                for($i = 0; $i<$applyInfo["apply_week_num"];$i++){
                    if($i>$applyInfo["apply_week_num"]-2){
                        $applyInfo["apply_week_bens"]=$datas-$applyInfo["apply_week_ben"]*$i;
                        $applyInfo["apply_week_amts"]=$applyInfo["apply_week_amt"]-$applyInfo["apply_week_ben"]+$applyInfo["apply_week_bens"];
                        $applyInfo["apply_amt_all_firsts"]=$applyInfo["apply_week_bens"];
                        $applyInfo["apply_amt_all_lasts"]=0;

                    }else{
                        $applyInfo["apply_week_bens"]= $applyInfo["apply_week_ben"];
                        $applyInfo["apply_week_amts"]= $applyInfo["apply_week_amt"];
                        $applyInfo["apply_amt_all_firsts"]=$datas-$applyInfo["apply_week_bens"]*$i;
                        $applyInfo["apply_amt_all_lasts"]=$datas-($i+1)*$applyInfo["apply_week_bens"];
                    }
                    $ck1_sign_times[] = [
                        "time"  =>date("Y/m/d", (($applyInfo["loan_category"]=="佰事贷"?$applyInfo["ck1_sign_time"]:($applyInfo["ck1_sign_time"]+518400)) + 604800 * $i)),
                        "apply_amt_all_first"=>$applyInfo["apply_amt_all_firsts"],
                        "apply_week_ben"=>$applyInfo["apply_week_bens"],
                        "apply_week_intreset"=>(($applyInfo["loan_category"]=="佰事贷")?$applyInfo["apply_week_amts"]:$applyInfo["apply_week_amt"])-$applyInfo["apply_week_bens"],
                        "apply_week_amt"=>($applyInfo["loan_category"]=="佰事贷")?$applyInfo["apply_week_amts"]:$applyInfo["apply_week_amt"],
                        "apply_amt_all_last"=>$applyInfo["apply_amt_all_lasts"],
                        "apply_service_amt"=>round($applyInfo["apply_service_amt"]-($applyInfo["apply_service_amt"]/$applyInfo["apply_week_num"]*($i+1)),2),
                    ];
                        $data["time"]=$ck1_sign_times[$i]["time"];
                        $data["apply_week_amt"]=$ck1_sign_times[$i]["apply_week_amt"];
                        $data["apply_week_now"]=$i+1;
                        $data["apply_amt_all_first"]=$ck1_sign_times[$i]["apply_amt_all_first"];
                        $data["apply_amt_all_last"]=$ck1_sign_times[$i]["apply_amt_all_last"];
                        $data["apply_service_amt"]=$ck1_sign_times[$i]["apply_service_amt"];
                        $data["apply_week_ben"]=$ck1_sign_times[$i]["apply_week_ben"];
                        $data["apply_week_intreset"]=$ck1_sign_times[$i]["apply_week_intreset"];
                        $data["user_id"]=$applyInfo["user_id"];
                        $data["city"]=$applyInfo["city"];
                        $data["city_num"]=$applyInfo["city_num"];
                        $data["district"]=$applyInfo["district"];
                    $this->Repay->insertGetId($data);
                }

                return true;

    }
    /**
     * 获取面审录入详情
     * @param $apply_id
     */
    public function getFaceDetailById($applier_name){
          $condition = [
              ["applier_name",$applier_name],
              // ["status","!=",AssetApply::$STATUS_DELETE]
          ];
        $info = $this->Face_trial->where($condition)
            ->first();
        $info->type9 =AssetFace_trial::$STATUS_NAME_ITEM[$info->type9];
         $info->type10 =AssetFace_trial::$STATUS_NAME_ITEM[$info->type10];
        return $info;
    }
    /**
     * 获取申请详情
     * @param $apply_id
     */
    public function getApplyDetailById($apply_id){
        $condition = [
            ["apply_id",$apply_id],
           // ["status","!=",AssetApply::$STATUS_DELETE]
        ];
        $info = $this->Apply->where($condition)
            ->first();
        isset($info->status)?$info->status_name = AssetApply::$STATUS_NAME_ITEM[$info->status]:null;
        $info->applier_sex = AssetApply::$applier_sex[$info->applier_sex];
        $info->applier_education = AssetApply::$applier_education[$info->applier_education];
        $info->applier_marriage = AssetApply::$applier_marriage[$info->applier_marriage];
        $info->job_character = AssetApply::$job_character[$info->job_character];
        $info->company_character = AssetApply::$company_character[$info->company_character];
        $info->house = AssetApply::$house[$info->house];
        $info->applier_relative = AssetApply::$applier_relative[$info->applier_relative];
        $info->applier_relative1 = AssetApply::$applier_relative1[$info->applier_relative1];
        $info->relative_notice = AssetApply::$relative_notice[$info->relative_notice];
        $info->emergency_relative = AssetApply::$emergency_relative[$info->emergency_relative];
        $info->colleague_relative = AssetApply::$colleague_relative[$info->colleague_relative];
        $info->applier_purpose = AssetApply::$applier_purpose[$info->applier_purpose];
        return $info;
    }
    /**
     * 获取还款详情
     * @param $apply_id
     */
    public function getRepayDetailById($apply_id){
        $condition = [
            ["apply_id",$apply_id],
          //  ["status","!=",AssetApply::$STATUS_DELETE]
        ];
        $info = $this->Repay->where($condition)
            ->get();
        foreach ($info as $v){
            isset($v->status)?$v->status_name = AssetRepay::$STATUS_NAME_ITEM[$v->status]:"--";
            empty($v->real_amt_all)?$v->real_amt_all ="--":$v->real_amt_all;
        }
        return $info;
    }
    /**
     * 获取还款详情
     * @param $apply_id
     */
    public function getRepayDetail($apply_id){
        $condition = [
            ["id",$apply_id],
            //  ["status","!=",AssetApply::$STATUS_DELETE]
        ];
        $info = $this->Repay->where($condition)
            ->first();
        return $info;
    }
    /**
     * 还款信息操作
     */
    public function getRepayUpdate($repay_id,$status,$apply_week_amt,$real_amt_all,$apply_week_num,$apply_week_now){
        $data["status"] = $status;
        $data["real_amt_all"] = $real_amt_all;//dd($data["status"]);exit;
        if($data["status"]==3){
            $data["status"] = $status;
            $data["real_amt_all"] = $real_amt_all;
            $a=$apply_week_num-$apply_week_now;
            $sum=$repay_id;
            for($i=0;$i<=$a;$i++){
                // dd($i);
                $u = $this->Repay->where("id",$sum+$i)->update($data);
            }
        }elseif($data["status"]==2){
            $data["repay_late_days"]=0;
            $data["repay_late_amt"]=0;
            $data["now_amt_all"]=$apply_week_amt;
            $u = $this->Repay->where("id",$repay_id)->update($data);
        }else{
            $u = $this->Repay->where("id",$repay_id)->update($data);

        }
        return $u;
    }

    /**
     * 删除申请
     */
    public function deleteApply($apply_id,$user_id){
        $data["update_time"] = time();
        $data["status"] = AssetApply::$STATUS_DELETE;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = ApplyLog::$RESULT_NORMAL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_DELETE,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }
    }


    /**
     * 获取申请单证书列表
     * @param $apply_id
     */
    public function getApplyCertItemByApplyId($apply_id){
        $ApplyCert = new ApplyCert();
        $condition = [
            ["apply_id", $apply_id],
            ["status",ApplyCert::$STATUS_ENABLE],
        ];
        return $ApplyCert->where($condition)
            ->get();
    }

    /**
     * 根据Id更新申请基本信息
     */
    public function updateApplyBaseInfoById($apply_id,$data,$user_id){
        $data["update_time"] = time();
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_UPDATE_INFO,$user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }

    /**
     * 资产一审
     * @param $apply_id
     * @param $pass
     * @param $ck_remark
     * @param $ck_user_id
     */
    public function applyAssetCheck1($apply_id,$pass,$ck_remark,$ck_user_id){
        $data["update_time"] = time();
        $data["asset_ck1_remark"] = $ck_remark?$ck_remark:null;
        $data["ck1_asset_id"] = $ck_user_id;
       if($pass==0){
           $data["status"] =AssetApply::$STATUS_ASSET_CHECK1_FAIL;
       }
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = $pass?ApplyLog::$RESULT_SUCCESS:ApplyLog::$RESULT_FAIL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_ASSET_CK1,$ck_user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }
    }
    /**
     * 合同签约
     */
    public function applySign($apply_id,$user_id){
            $data["ck1_sign_time"] = time();
        $data["status"] =AssetApply::$STATUS_WAIT_UPLOAD;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = 1;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_WAIT_UPLOAD,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }
    /**
     * 合同拒绝
     */
    public function applyRefuse($apply_id,$user_id){
        $data["status"] =AssetApply::$STATUS_TRAIL_FAIL;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = 1;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_TRAIL_FAIL,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }
    /**
     * 合同上传
     */
    public function applyUpload($apply_id,$zip,$user_id){
        $data["zip_auth"] = $zip;
//        $data["status"] = AssetApply::$STATUS_WAIT_LOAD;
        $data["status"] = AssetApply::$STATUS_WAIT_FINAL_JUDGMENT;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = 1;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_WAIT_FINAL_JUDGMENT,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }
    /**
     * 初审审核
     * @param $apply_id
     * @param $pass
     * @param $ck_remark
     * @param $ck_user_id
     */
    public function applyChushen($apply_id,$pass,$datas,$user_id){
        $data["chushen_time"] = time();
        $data["chushen_remark"] = $datas["remark"];
        if(isset($datas["apply_amt_final"])){
            $data["apply_amt_final"] = $datas["apply_amt_final"];
        }
        $data["chushen_id"] = $user_id;
        $data["status"] = $pass;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = $pass?ApplyLog::$RESULT_SUCCESS:ApplyLog::$RESULT_FAIL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_CHUSHEN,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }
    }

    /**
     * 复审审核
     */
    public function applyFushen($apply_id,$pass,$remark,$user_id){
        $data["fushen_time"] = time();
        $data["fushen_remark"] = $remark;
        $data["fushen_id"] = $user_id;
        $data["status"] = $pass;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = $pass==AssetApply::$STATUS_WAIT_FINAL_JUDGMENT?ApplyLog::$RESULT_SUCCESS:ApplyLog::$RESULT_FAIL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_FUSHEN,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }
    /**
     * 终审审核
     */
    public function applyZhongshen($apply_id,$pass,$remark,$user_id){
        $data["zhongshen_time"] = time();
        $data["zhongshen_remark"] = $remark;
        $data["zhongshen_id"] = $user_id;
        $data["status"] = $pass;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = $pass==AssetApply::$STATUS_WAIT_GENERATE?ApplyLog::$RESULT_SUCCESS:ApplyLog::$RESULT_FAIL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_ZHONGSHEN,$user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }
    /**
     * 风控二审
     */
    public function applyRiskctlCheck2($apply_id,$pass,$ck_remark,$ck_user_id){
        $data["update_time"] = time();
        $data["riskctl_ck2_remark"] = $ck_remark?$ck_remark:null;
        $data["ck2_riskctl_id"] = $ck_user_id;
        $data["status"] = $pass;
        if($pass == AssetApply::$STATUS_WAIT_PUBLISH){
            $data["ck2_pass_time"] = time();
        }
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $result = $pass?ApplyLog::$RESULT_SUCCESS:ApplyLog::$RESULT_FAIL;
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_RISKCTL_CK2,$ck_user_id,$result,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }

    }

    /**
     * 补充视频资料
     */
    public function completApply($apply_id,$video,$user_id){
        $data["update_time"] = time();
        $data["video_auth"] = $video;
        $data["status"] = AssetApply::$STATUS_WAIT_ASSET_CHECK2;
        $data["ck2_submit_time"]    = time();
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_COMPLET,$user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }
    }
    /**
     * 聚立信录入与否
     */
    public function jlx_update($apply_id){
        $data["jlx"] = "yes";
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
           return $u;
        }else{
            return false;
        }
    }
    /**
     * 补充借款人压缩包资料（一审）
     */
    public function completApplyZip($apply_id,$zip,$user_id){
        $data["update_time"] = time();
        $data["applier_zip"] = $zip;
        if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
            //记录操作日志
            $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_WAIT_UPLOAD,$user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
            return $u;
        }else{
            return false;
        }
    }


    /**
     * 更改为发标
     */
    public function publishApply($apply_id,$remark,$operater_user_id){
        if($applyInfo = $this->Apply->where("apply_id",$apply_id)->first()){
            if($applyInfo->status != AssetApply::$STATUS_WAIT_PUBLISH){
                return false;
            }else{
                $data["status"] =  AssetApply::$STATUS_WAIT_FULL;
                $data["operator_remark"]    = $remark?$remark:null;
                $data["operator_id"] = $operater_user_id;
                $data["publish_time"] = time();
                if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
                    //记录操作日志
                    $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_PUBLISH_APPLY,$operater_user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
                    return $u;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    /**
     * 更改满标状态
     */
    public function fullApply($apply_id,$operator_user_id){
        if($applyInfo = $this->Apply->where("apply_id",$apply_id)->first()){
            if($applyInfo->status != AssetApply::$STATUS_WAIT_FULL){
                return false;
            }else{
                $data["status"] =  AssetApply::$STATUS_FULL;
                $data["operator_id"] = $operator_user_id;
                $data["full_time"] = time();
                if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
                    //记录操作日志
                    $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_FULL_APPLY,$operator_user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
                    return $u;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    /**
     * 更改为已放款状态
     */
    public function finishLoan($apply_id,$remark,$pass,$financer_user_id){
        if($applyInfo = $this->Apply->where("apply_id",$apply_id)->first()){

                $data["status"] =  $pass;
                $data["financer_id"] = $financer_user_id;
                $data["financer_remark"] = $remark;
                $data["finish_loan_time"] = time();
                if($u = $this->Apply->where("apply_id",$apply_id)
                    ->update($data)){
                    //记录操作日志
                    $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_FINISH_LOAN,$financer_user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
                    return $u;
                }else{
                    return false;
                }

        }else{
            return false;
        }
    }
    /**
     * 更改满标状态
     */
    public function repay($apply_id,$operator_user_id){
        if($applyInfo = $this->Apply->where("apply_id",$apply_id)->first()){
            if($applyInfo->status != AssetApply::$STATUS_WAIT_FULL){
                return false;
            }else{
                $data["status"] =  AssetApply::$STATUS_FULL;
                $data["operator_id"] = $operator_user_id;
                $data["full_time"] = time();
                if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
                    //记录操作日志
                    $this->ApplyLog->createNew($apply_id,ApplyLog::$LOG_TYPE_FULL_APPLY,$operator_user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
                    return $u;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    /**
     * 更新状态
     */
    public function updateApplyStatus($apply_id,$status,$user_id){
        if($applyInfo = $this->Apply->where("apply_id",$apply_id)->first()){
            if(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_FIRST_TRIAL,AssetApply::$STATUS_MODIFY])){
                return false;
            }else{
                $data["status"] =  $status;
                $data["update_time"] = time();
                if($u = $this->Apply->where("apply_id",$apply_id)->update($data)){
                    //记录操作日志
                    $this->ApplyLog->createNew($apply_id,ApplyLog::$STATUS_MODIFY,$user_id,ApplyLog::$RESULT_NORMAL,json_encode($data,JSON_UNESCAPED_UNICODE));
                    return $u;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    /**
     * 数字转换成大写
     */
    public function transBig($num){
        switch ($num)
        {
            case 0:
                $char="零";
                break;
            case 1:
                $char="壹";
                break;
            case 2:
                $char="贰";
                break;
            case 3:
                $char="叁";
                break;
            case 4:
                $char="肆";
                break;
            case 5:
                $char="伍";
                break;
            case 6:
                $char="陆";
                break;
            case 7:
                $char="柒";
                break;
            case 8:
                $char="捌";
                break;
            case 9:
                $char="玖";
                break;
            default:
                $char="";
                break;
        }
        return $char;
    }
    function cny($applyInfo) {
        if($applyInfo["apply_amt_all_1"]!=""){
            $applyInfo["char"].=$applyInfo["apply_char_1"]."拾";
            if($applyInfo["apply_amt_all_2"]!=""){
                $applyInfo["char"].=$applyInfo["apply_char_2"];
            }else{
                $applyInfo["char"].="万";
            }
        }elseif($applyInfo["apply_amt_all_2"]==""){

        }else{
            $applyInfo["char"].=$applyInfo["apply_char_2"]."万";
        }
        if($applyInfo["apply_amt_all_3"]!=""){
            $applyInfo["char"].=$applyInfo["apply_char_3"]."仟";
        }
        if($applyInfo["apply_amt_all_4"]!=""){
            $applyInfo["char"].=$applyInfo["apply_char_4"]."佰";
        }
        if($applyInfo["apply_amt_all_5"]!=""){
            $applyInfo["char"].=$applyInfo["apply_char_5"]."拾";
        }
        if($applyInfo["apply_amt_all_6"]!=""){
            $applyInfo["char"].=$applyInfo["apply_char_6"];
        }
        if(($applyInfo["apply_amt_all_7"]!="")||($applyInfo["apply_amt_all_8"]!="")){
            $applyInfo["char"].="圆";
            if($applyInfo["apply_amt_all_7"]!=""){
                $applyInfo["char"].=$applyInfo["apply_char_7"]."角";
            }
            if($applyInfo["apply_amt_all_8"]!=""){
                $applyInfo["char"].=$applyInfo["apply_char_8"]."分";
            }
        }else{
            $applyInfo["char"].="圆整";
        }
        return $applyInfo["char"];
    }
    function cnys($applyInfo) {
        if($applyInfo["apply_service_amt_1"]!=""){
            $applyInfo["service"].=$applyInfo["apply_chars_1"]."拾";
            if($applyInfo["apply_service_amt_2"]!=""){
                $applyInfo["service"].=$applyInfo["apply_chars_2"];
            }else{
                $applyInfo["service"].="万";
            }
        }elseif($applyInfo["apply_service_amt_2"]==""){

        }else{
            $applyInfo["service"].=$applyInfo["apply_chars_2"]."万";
        }
        if($applyInfo["apply_service_amt_3"]!=""){
            $applyInfo["service"].=$applyInfo["apply_chars_3"]."仟";
        }
        if($applyInfo["apply_service_amt_4"]!=""){
            $applyInfo["service"].=$applyInfo["apply_chars_4"]."佰";
        }
        if($applyInfo["apply_service_amt_5"]!=""){
            $applyInfo["service"].=$applyInfo["apply_chars_5"]."拾";
        }
        if($applyInfo["apply_service_amt_6"]!=""){
            $applyInfo["service"].=$applyInfo["apply_chars_6"];
        }
        if(($applyInfo["apply_service_amt_7"]!="")||($applyInfo["apply_service_amt_8"]!="")){
            $applyInfo["service"].="圆";
            if($applyInfo["apply_service_amt_7"]!=""){
                $applyInfo["service"].=$applyInfo["apply_chars_7"]."角";
            }
            if($applyInfo["apply_service_amt_8"]!=""){
                $applyInfo["service"].=$applyInfo["apply_chars_8"]."分";
            }
        }else{
            $applyInfo["service"].="圆整";
        }
        return $applyInfo["service"];
    }
}