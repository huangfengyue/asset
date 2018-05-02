<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/13
 * Time: 17:18
 */

namespace App\Models;


class ApplyLog extends BaseModel
{
    public $timestamps = false;
    protected $table = "ast_log";
    protected $primaryKey = "log_id";


    //日志类型
    static public $LOG_TYPE_UPDATE_INFO = 1;    //用户修改信息
    static public $LOG_TYPE_CHUSHEN = 2;      //初审
    static public $LOG_TYPE_FUSHEN = 3;    //复审
    static public $LOG_TYPE_ZHONGSHEN = 4;      //终审
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



    //日志结果
    static public $RESULT_NORMAL = 0;
    static public $RESULT_SUCCESS = 1;
    static public $RESULT_FAIL = 2;

    /**
     * 创建新日志
     * @param $apply_id
     * @param $log_type
     * @param $user_id
     * @param $result
     * @param $data
     */
    public function createNew($apply_id,$log_type,$user_id,$result,$data){
        $newData["apply_id"]   = $apply_id;
        $newData["log_type"]   = $log_type;
        $newData["user_id"]    = $user_id;
        $newData["result"] = $result;
        $newData["data"] = $data;
        $newData["create_time"] = time();
        return $this->insertGetId($newData);
    }
}