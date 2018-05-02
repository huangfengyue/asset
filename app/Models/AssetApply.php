<?php
/**
 * 资产申请表
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/7
 * Time: 18:01
 */

namespace App\Models;


class AssetApply extends BaseModel
{
    protected $table = "ast_apply";
    public $timestamps = false;
    protected $primaryKey = "apply_id";

    //状态
    static public $STATUS_WAIT_FIRST_TRIAL = 1;    //等待初审
    static public $STATUS_FIRST_TRIAL_FAIL = 2;  //初审拒绝
    static public $STATUS_RETRIAL = 3;  //等待复审
    static public $STATUS_RETRIAL_FAIL = 4;  //复审拒绝
    static public $STATUS_WAIT_FINAL_JUDGMENT  = 5;    //等待终审
    static public $STATUS_FINAL_JUDGMENT_FAIL = 6;  //终审拒绝
    static public $STATUS_MODIFY =7;  //退回修改
    static public $STATUS_WAIT_GENERATE =8;  //等待生成
    static public $STATUS_WAIT_UPLOAD =9;  //等待上传
    static public $STATUS_WAIT_LOAD =10;  //等待放款
    static public $STATUS_TRAIL_FAIL = 11;     //拒绝面签
    static public $STATUS_REFUSE_LOAD =12;  //拒绝放款
    static public $STATUS_FINISH_LOAN = 14;     //已放款
    static public $STATUS_FINISH_REPAY = 15;    //已还款
    static public $STATUS_DELETE = 99;  //软删除
    //状态名
    static public $STATUS_NAME_ITEM = [
        1   =>  "等待审核",
        2   =>  "初审拒绝",
        3   =>  "待释放合同",
        4   =>  "复审拒绝",
        5   =>  "等待终审",
        6   =>  "终审拒绝",
        7   =>  "退回修改",
        8   =>  "合同签约",
        9   =>  "上传签约资料",
        10   =>  "等待到账",
        11   =>  "拒绝面签",
        12   =>  "拒绝放款",
        14   =>  "已放款",
        15   =>  "已还款",
        99  =>  "已删除",
    ];


    //还款方式集合
    static public $REPAY_TYPE_ITEM = [
        1,  //当前只支持 1等本等息
    ];

    //申请金额
    static public $APPLY_AMT_MIN = 100; //最小
    static public $APPLY_AMT_MAX = 100000;  //最大

    //期限范围
    static public $DEADLINE_MIN = 1;    //最小值
    static public $DEADLINE_MAX = 1000; //最大值

    //期限类型(单位)
    static public $DEADLINE_TYPE_DAY = 1;
    static public $DEADLINE_TYPE_YEAR = 2;

    //期限类型
    static public $DEADLINE_TYPE_ITEM = [
        1,2
    ];

    //还款类型
    static public $REPAY_TYPE_DBDX = 1; //等本等息

    static public  $applier_sex = [
        0=>"男",
        1=>"女",
    ];
    static public  $applier_education = [
        0=>"硕士及以上",
        1=>"本科",
        2=>"大专",
        3=>"中专",
        4=>"高中及以下",
    ];
    static public  $applier_marriage = [
        0=>"未婚",
        1=>"已婚",
        2=>"离异",
        3=>"再婚",
        4=>"其他",
    ];
    static public  $job_character = [
        0=>"自雇",
        1=>"管理人员",
        2=>"正式职员",
        3=>"合同制",
        4=>"其他",
    ];
    static public  $company_character = [
        0=>"政府机构",
        1=>"事业单位",
        2=>"民营",
        3=>"外资/合资",
        4=>"国有企业",
        5=>"社会团体",
    ];
    static public  $house = [
        0=>"亲属产权",
        1=>"自建房",
        2=>"无按揭房产",
        3=>"按揭房产",
        4=>"单位宿舍",
        5=>"租房",
    ];
    static public  $applier_relative = [
        0=>"父母",
        1=>"配偶",
        2=>"子女",
        3=>"其他",
    ];
    static public  $applier_relative1 = [
        0=>"父母",
        1=>"配偶",
        2=>"子女",
        3=>"其他",
    ];
    static public  $relative_notice = [
        0=>"否",
        1=>"是",
    ];
    static public  $emergency_relative = [
        0=>"同事",
        1=>"朋友",
        2=>"亲属",
        3=>"其他",
    ];
    static public  $colleague_relative = [
        0=>"同事",
        1=>"领导",
        2=>"下属",
        3=>"其他",
    ];
    static public  $applier_purpose = [
        0=>"资金周转",
        1=>"购物",
        2=>"教育",
        3=>"装修",
        4=>"旅游",
        5=>"扩大经营",
        6=>"医疗",
        7=>"其他",
    ];
}