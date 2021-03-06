<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 10:27
 */

namespace App\Http\Controllers\Agency;


use App\Http\Controllers\Agency\Base\BaseController;
use App\Models\ApplyCert;
use App\Models\AssetApply;
use App\Models\Enlist;
use App\Services\AssetService;
use App\Services\CertService;
use App\Services\OssServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Excel;

class TestController extends BaseController
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
        echo 35;exit;
            //预生成模型数据

            $data["repay_type"] = 1;    //等本等息

            if($re = $this->RedisService->set("cacheApply111:".$this->userInfo->user_id,$data,config("agency.apply.maxLife"))){
                $data1 = $this->RedisService->get("cacheApply111:".$this->userInfo->user_id)
                return $data1;
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }

    }
    /**
     * 还款跟踪列表
     */
    public function repay(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $conditions = [
                ["time","<=",date("Y/m/d",time())],
                ["user_id",$this->userInfo->user_id],
            ];
            $res = $this->AssetService->getRepayList($pageOption,1,$conditions);

            return $this->responseJson(200,"ok",$res);
        }else{
            return $this->view();
        }
    }
    /**
     * 添加面审目录
     */
    public function face_trial(Request $request){
        if($request->ajax()){
            //预生成模型数据
            $data=$_POST;//dd($data);exit;
            if($apply_id = $this->AssetService->create_Face_trial($data,$this->userInfo->user_id)){
                $res["url"] = "/asset/create";
                return $this->responseJson(200,"ok",$res);
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
        }else{
            return $this->view();
        }
    }
    /**
     * 选择贷款类别
     */
    public function loan_category(Request $request){
        if($request->ajax()){
            //预生成模型数据
            $data=$_POST;
            if($re = $this->RedisService->set("cacheApply:".$this->userInfo->user_id,$data,config("agency.apply.maxLife"))){
                $res["url"] = "/asset/create";
                return $this->responseJson(200,"ok",$res);
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
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
     * 发起新申请
     */
    public function create(Request $request){
        if($request->ajax()){
            //预生成模型数据
            $data=$_POST;
            $data["repay_type"] = 1;    //等本等息
            if($data1 = $this->RedisService->get("cacheApply:".$this->userInfo->user_id)){
                $data=array_merge($_POST,json_decode($data1,true));
            }else{
                return $this->responseJson(0,"1保存失败,请稍后重试");
            }
            if($re = $this->RedisService->set("cacheApply0:".$this->userInfo->user_id,$data,config("agency.apply.maxLife"))){
                $res["url"] = "/asset/create1";
                return $this->responseJson(200,"ok",$res);
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
        }else{
            return $this->view();
        }
    }
    /**
     * 发起新申请第二页
     */
    public function create1(Request $request){
       // dd($_POST);exit;
        if($request->ajax()){
            //预生成模型数据
            if($data1 = $this->RedisService->get("cacheApply0:".$this->userInfo->user_id)){
                $data=array_merge($_POST,json_decode($data1,true));
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }

            if($re = $this->RedisService->set("cacheApply1:".$this->userInfo->user_id,$data,config("agency.apply.maxLife"))){
                $res["url"] = "/asset/create2";
                return $this->responseJson(200,"ok",$res);
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
        }else{
            return $this->view();
        }
    }
    /**
     * 发起新申请第三页
     */
    public function create2(Request $request){
        if($request->ajax()){
            //预生成模型数据
            if($data1 = $this->RedisService->get("cacheApply1:".$this->userInfo->user_id)){
                $data=array_merge($_POST,json_decode($data1,true));
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
            if($re = $this->RedisService->set("cacheApply2:".$this->userInfo->user_id,$data,config("agency.apply.maxLife"))){
                $res["url"] = "/asset/create/upzip";
                return $this->responseJson(200,"ok",$res);
            }else{
                return $this->responseJson(0,"保存失败,请稍后重试");
            }
        }else{
            return $this->view();
        }
    }
//    public function createStep2(Request $request){
//        if($request->isMethod("post")){
//            if($data = $this->RedisService->get("cacheApply:".$this->userInfo->user_id)){
//                $imgItem = [];
//                foreach ($request->allFiles() as $k => $v){
//                    $type_id = str_replace("type_id_","",$k);
//                    foreach ($v as $ik => $iv){
//                        if($saveName = OssServices::putImg($iv)){
//                            $imgItem[] = [
//                                "type_id"   =>  $type_id,
//                                "uri"   =>  $saveName,
//                                "create_time"   =>  time(),
//                            ];
//                        }else{
//                            return $this->error("图片格式有误，当前只支持png/jpg/jpeg/gif格式");
//                        }
//                    }
//                }
//                if(!$imgItem){
//                    return $this->error("证书上传为空，请检查");
//                }
//                //创建订单
//                if($apply_id = $this->AssetService->createNew(json_decode($data,true),$this->userInfo->user_id)){
//                    $CertService = new CertService();
//                    if($CertService->saveCertItem($imgItem,$apply_id)){
//                        $this->RedisService->del("cacheApply:".$this->userInfo->user_id);
//                        return $this->success("提交成功","/agency/asset");
//                    }else{
//                        return $this->error("提交失败，证书上传出错");
//                    }
//                }else{
//                    return $this->error("创建失败，请联系官方解决问题");
//                }
//
//            }else{
//                return $this->error("数据失效，请重新填写资料","/asset/create");
//            }
//        }else{
//            if($this->RedisService->get("cacheApply:".$this->userInfo->user_id)){
//                $data["certTypeItem"] = $this->CertService->getTypeItem();
//                return $this->view()->with($data);
//            }else{
//                return $this->error("数据失效，请重新填写资料","/asset/create");
//            }
//        }
//    }

    public function createUpZip(Request $request){
        if($request->isMethod("post")){
            $zip = $request->file("zip");

            if($data =$this->RedisService->get("cacheApply2:".$this->userInfo->user_id)){
               // var_dump(json_decode($data,true));exit;
                $zipItem = [];
                //oss存储压缩包
                if($filePath = OssServices::putZip($zip)){
                    $zipItem[] = [
                        "type_id"   =>  0,
                        "uri"   =>  $filePath,
                        "create_time"   =>  time(),
                    ];
                }else{
                    return $this->error("压缩包上传失败");
                }

                if(!$zipItem){
                    return $this->error("压缩包上传为空，请检查");
                }

                //创建订单
                if($apply_id = $this->AssetService->createNew(json_decode($data,true),$this->userInfo->user_id)){
                    $CertService = new CertService();
                    if($CertService->saveCertItem($zipItem,$apply_id)){
                        $this->AssetService->completApplyZip($apply_id,$filePath,$this->userInfo->user_id);
                        $this->RedisService->del("cacheApply:".$this->userInfo->user_id);
                        $this->RedisService->del("cacheApply0:".$this->userInfo->user_id);
                        $this->RedisService->del("cacheApply1:".$this->userInfo->user_id);
                        $this->RedisService->del("cacheApply2:".$this->userInfo->user_id);
                        return $this->success("提交成功","/agency/asset");
                    }else{
                        return $this->error("提交失败，压缩包上传出错");
                    }
                }else{
                    return $this->error("创建失败，请联系官方解决问题");
                }

            }else{
                return $this->error("数据失效，请重新填写资料","/agency/asset/create");
            }
        }else{
            if($this->RedisService->get("cacheApply2:".$this->userInfo->user_id)){
                $data["certTypeItem"] = $this->CertService->getTypeZip();
                return $this->view()->with($data);
            }else{
                return $this->error("数据失效，请重新填写资料","/agency/asset/create");
            }
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
                return $this->error("单子异常，还能获得二审资料");
            }
        }else{
            return $this->error("改单已失效");
        }
    }

    /**
     * 修改申请
     */
    public function updateApply(Request $request,$apply_id){
        if($request->ajax()){
            //预生成模型数据
            $data=$_POST;
            $data["repay_type"] = 1;    //等本等息
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_ASSET_CHECK1,AssetApply::$STATUS_RISKCTL_CK1_MODIFY])){
                    return $this->responseJson(0,"该单状态异常，无法更改信息");
                }
                if($re = $this->AssetService->updateApplyBaseInfoById($apply_id,$data,$this->userInfo->user_id)){
                    $res["url"] = "/asset/".$apply_id."/update";
                    //更改状态
                    if($this->AssetService->updateApplyStatus($apply_id,AssetApply::$STATUS_WAIT_ASSET_CHECK1,$this->userInfo->user_id)){
                        return $this->responseJson(200,"ok",$res);
                    }else{
                        return $this->responseJson(200,"状态更改失败");
                    }
                }else{
                    return $this->responseJson(0,"保存失败,请稍后重试");
                }
            }else{
                return $this->responseJson(0,"申请单数据无效");
            }

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_ASSET_CHECK1,AssetApply::$STATUS_RISKCTL_CK1_MODIFY])){
                    return $this->error("该单状态异常，无法更改信息");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }

    /**
     * 修改证件信息
     */
    public function updateApplyCert(Request $request,$apply_id){
        if($request->isMethod("post")) {
             $zip = $request->file("zip");
              if($zip){
            if ($applyInfo = $this->AssetService->getApplyDetailById($apply_id)) {
                if (!in_array($applyInfo->status, [AssetApply::$STATUS_WAIT_ASSET_CHECK1, AssetApply::$STATUS_RISKCTL_CK1_MODIFY])) {
                    return $this->error("该单状态异常，无法更改信息");
                }
                //oss存储资料
                if ($filePath = OssServices::putZip($zip)) {
                    if ($this->AssetService->completApplyZip($apply_id, $filePath, $this->userInfo->user_id)) {
                        return $this->success("保存成功", "/agency/asset");
                    } else {
                        return $this->error("资料修改失败");
                    }
                } else {
                    return $this->error("资料修改失败");
                }
                return $this->view()->with(["applyInfo" => $applyInfo]);
            } else {
                return $this->error("申请单数据无效", "/asset");
            }
            }else{
                return $this->error("必须上传有效的压缩包");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
//                if(!in_array($applyInfo->status , [AssetApply::$STATUS_WAIT_COMPLETION,AssetApply::$STATUS_WAIT_ASSET_CHECK2,AssetApply::$STATUS_RISKCTL_CK2_MODIFY])){
//                    return $this->error("状态不匹配，无法修改");
//                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("单子丢失了");
            }
        }
    }

    /**
     * 根据证件类型ID修改证件
     */
    public function updateApplyCertByTypeId(Request $request,$apply_id,$type_id){
        if($request->isMethod("post")){
            //验证有效性
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->user_id != $this->userInfo->user_id){
                    return $this->error("您没有权限操作该申请");
                }elseif(!in_array($applyInfo->status,[AssetApply::$STATUS_WAIT_ASSET_CHECK1,AssetApply::$STATUS_RISKCTL_CK1_MODIFY])){
                    return $this->error("改单状态异常，无法更改");
                }else{
                    $certFileItem = $request->file("certFile");
                    $imgItem = [];
                    foreach ($certFileItem as $k => $v){
                        if($saveName = OssServices::putImg($v)){
                            $imgItem[] = [
                                "type_id"   =>  $type_id,
                                "uri"   =>  $saveName,
                                "create_time"   =>  time(),
                            ];
                        }else{
                            return $this->error("图片格式有误，当前只支持png/jpg/jpeg/gif格式");
                        }
                    }
                    if(!$imgItem){
                        return $this->error("证书上传为空，请检查");
                    }

                    //删除原同类型证件
                    $CertService = new CertService();
                    if($CertService->deleteApplyCertItemByTypeId($type_id,$apply_id)){
                        if($CertService->saveCertItem($imgItem,$apply_id)){
                            //更改状态
                            if($this->AssetService->updateApplyStatus($apply_id,AssetApply::$STATUS_WAIT_ASSET_CHECK1,$this->userInfo->user_id)){
                                return $this->success("提交成功");
                            }else{
                                return $this->error("状态更改失败");
                            }
                        }else{
                            return $this->error("提交失败，证书上传出错");
                        }
                    }else{
                        return $this->error("提交失败，原证书无法删除");
                    }
                }
            }else{
                return $this->error("申请单不存在");
            }

        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                $CertService = new CertService();
                $typeInfo = $CertService->getCertInfoByTypeId($type_id);
                return $this->view()->with(["applyInfo"=>$applyInfo,"typeInfo"=>$typeInfo]);
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }
    }

    /**
     * 更新补充资料
     */
    public function updateComplet(Request $request,$apply_id){
        if($request->isMethod("post")){
            $zip = $request->file("zip");
            if($zip){
                if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                    if(!in_array($applyInfo->status , [AssetApply::$STATUS_WAIT_COMPLETION,AssetApply::$STATUS_WAIT_ASSET_CHECK2,AssetApply::$STATUS_RISKCTL_CK2_MODIFY])){
                        return $this->error("状态不匹配，保存失败");
                    }
                    //oss存储资料
                    if($filePath = OssServices::putZip($zip)){
                        if($this->AssetService->completApplyZips($apply_id,$filePath,$this->userInfo->user_id)){
                            return $this->success("保存成功","/agency/asset/check2");
                        }else{
                            return $this->error("资料保存失败");
                        }
                    }else{
                        return $this->error("资料上传失败");
                    }
                }else{
                    return $this->error("单子丢失了");
                }
            }else{
                return $this->error("必须上传有效的压缩包");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if(!in_array($applyInfo->status , [AssetApply::$STATUS_WAIT_COMPLETION,AssetApply::$STATUS_WAIT_ASSET_CHECK2,AssetApply::$STATUS_RISKCTL_CK2_MODIFY])){
                    return $this->error("状态不匹配，无法修改");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("单子丢失了");
            }
        }
    }

    /**
     * 删除申请
     */
    public function delete(Request $request,$apply_id){
        if($request->ajax()){
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status == 1){
                    if($this->AssetService->deleteApply($apply_id,$this->userInfo->user_id)){
                        return $this->responseJson(200,"删除成功");
                    }else{
                        return $this->responseJson(0,"删除失败");
                    }
                }else{
                    return $this->responseJson(0,"无法删除");
                }
            }else{
                return $this->error("申请单数据无效","/asset");
            }
        }else{

        }
    }

    /**
     * 二审列表
     */
    public function listByCheck2(Request $request){
        if($request->ajax()){
            $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
            $condition = [
                ["user_id",$this->userInfo->user_id],
            ];
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
                $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                //还款总额
                $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
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
                $applyInfo["char"]=$this->AssetService->cny($applyInfo);
                //周偿还本息数额分割
                $applyInfo["apply_week_amt_1"]=(intval($applyInfo["apply_week_amt"]/1000)==0)?"":intval($applyInfo["apply_week_amt"]/1000);
                $applyInfo["apply_week_amt_2"]=((($applyInfo["apply_week_amt"]/100)%10==0)&&($applyInfo["apply_week_amt_1"]==""))?"":($applyInfo["apply_week_amt"]/100)%10;
                $applyInfo["apply_week_amt_3"]=((($applyInfo["apply_week_amt"]/10)%10==0)&&($applyInfo["apply_week_amt_1"]=="")&&($applyInfo["apply_week_amt_2"]==""))?"":($applyInfo["apply_week_amt"]/10)%10;
                $applyInfo["apply_week_amt_4"]=((($applyInfo["apply_week_amt"])%10==0)&&($applyInfo["apply_week_amt_1"]=="")&&($applyInfo["apply_week_amt_2"]=="")&&($applyInfo["apply_week_amt_3"]==""))?"":($applyInfo["apply_week_amt"])%10;
                $applyInfo["apply_week_amt_5"]=($applyInfo["apply_week_amt"]*10)%10;
                $applyInfo["apply_week_amt_6"]=($applyInfo["apply_week_amt"]*100)%10;
                //还款起始日
                $applyInfo["ck1_sign_time_first"]= date("Y/m/d",$applyInfo["ck1_sign_time"]);
                //还款终止日
                $applyInfo["ck1_sign_time_last"]= date("Y/m/d",($applyInfo["ck1_sign_time"]+604800*($applyInfo["apply_week_num"]-1)));
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
                $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                //还款总额
                $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
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
                $applyInfo["char"]=$this->AssetService->cny($applyInfo);
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
                $applyInfo["ck1_sign_time_last"]= date("Y/m/d",($applyInfo["ck1_sign_time"]+604800*($applyInfo["apply_week_num"]-1)));
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
                //周还款额
                $applyInfo["apply_week_amt"]=round((($applyInfo["apply_amt_final"]+$applyInfo["apply_amt_final"]*$applyInfo["day"]*0.003)/($applyInfo["day"]/7)),2);
                //平台服务费
                $applyInfo["apply_service_amt"]= round($applyInfo->apply_amt_final*0.528844,2);
                //还款总额
                $applyInfo["apply_amt_all"]=round($applyInfo->apply_amt_final*1.528844,2);
                //周还本金
                $applyInfo["apply_week_ben"]= round($applyInfo["apply_amt_all"]/$applyInfo["apply_week_num"],2);
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
     * 补充资料
     */
    public function complet(Request $request,$apply_id){
        if($request->isMethod("post")){
            $video = $request->file("video");
            if($video){
                if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                    if($applyInfo->status != AssetApply::$STATUS_WAIT_COMPLETION){
                        return $this->error("状态异常，无法操作");
                    }
                    //oss存储视频
                    if($filePath = OssServices::putVideo($video)){
                        if($this->AssetService->completApply($apply_id,$filePath,$this->userInfo->user_id)){
                            return $this->success("保存成功","/agency/asset/check2");
                        }else{
                            return $this->error("资料保存失败");
                        }
                    }else{
                        return $this->error("视频上传失败");
                    }
                }else{
                    return $this->error("单子丢失了");
                }
            }else{
                return $this->error("必须上传有效的视频");
            }
        }else{
            if($applyInfo = $this->AssetService->getApplyDetailById($apply_id)){
                if($applyInfo->status != AssetApply::$STATUS_WAIT_COMPLETION){
                    return $this->error("状态异常，无法操作");
                }
                return $this->view()->with(["applyInfo"=>$applyInfo]);
            }else{
                return $this->error("单子丢失了");
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
     * 导出excel
     */
    public function excel(Request $request){
        $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
        $condition = [
            ["user_id",$this->userInfo->user_id],
        ];
        $cellData = $this->AssetService->getApplyList($pageOption,1,$condition);
        $cellData=object2array($cellData["list"]);
        foreach ($cellData as $k=>$v){
            $cellData[$k]=object2array($v["attributes"]);
        }
        Excel::create('申请列表',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
    /**
     * 导出申请列表excel
     */
    public function list_excel(Request $request){
        $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
        $condition = [
            ["user_id",$this->userInfo->user_id],
        ];
        $cellData = $this->AssetService->getApplyList($pageOption,1,$condition);
        $cellData=object2array($cellData["list"]);
        $cellDatas["w"]=array("流水号","借款人","手机号","借款金额","借款期限","银行卡号","省会城市","类型","实际放款金额","最初上传时间","状态");
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
            $cellDatas[$k]["create_time"]=object2array($v["attributes"]["create_time"]);
            $cellDatas[$k]["status_name"]=object2array($v["attributes"]["status_name"]);
        }
        Excel::create('经销申请列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
    /**
     * 导出二审列表excel
     */
    public function ck2_excel(Request $request){
        $pageOption["pageNum"] = $request->get("p")>0?$request->get("p"):1;
        $condition = [
            ["user_id",$this->userInfo->user_id],
        ];
        $cellData = $this->AssetService->getApplyList($pageOption,2,$condition);
        $cellData=object2array($cellData["list"]);
        $cellDatas["w"]=array("流水号","借款人","手机号","借款金额","借款期限","银行卡号","省会城市","类型","实际放款金额","状态","最初上传时间");
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
        Excel::create('经销二审列表',function($excel) use ($cellDatas){
            $excel->sheet('score', function($sheet) use ($cellDatas){
                $sheet->rows($cellDatas);
            });
        })->export('xls');
    }
}