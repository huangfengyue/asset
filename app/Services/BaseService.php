<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/6
 * Time: 11:33
 */

namespace App\Services;


use Illuminate\Support\Facades\Cookie;

class BaseService
{
    protected static $DEFAULT_PER_PAGE_ROWS = 15;   //默认分页每页15条数据
    protected $userInfo;
    function __construct()
    {
        if($auth = Cookie::get("user_auth")){
            $auth = json_decode($auth);
            if(isset($auth->user_id) && $auth->user_id > 0){
                $this->userInfo = $auth;
            }
        }
    }

    /**
     * 制作分页
     */
    protected function makePager($totalRows=0,$pageNum=1,$perRows=15){
        $perRows = $perRows>0?$perRows:1; //默认每页15个数据
        if($pageNum>0){
            if($pageNum * $perRows <= $totalRows){
                $offset = ($pageNum -1) * $perRows;
            }else{
                $pageNum =  intval(ceil($totalRows/$perRows))>0?intval(ceil($totalRows/$perRows)):1;
                $offset = ($pageNum -1) * $perRows;
            }
        }else{
            $pageNum = 1;
            $offset = ($pageNum - 1) * $perRows;
        }
        $pager["totalRows"] = $totalRows;
        $pager["totalPage"] = intval(ceil($totalRows/$perRows));
        $pager["pageNum"] = $pageNum;
        $pager["perRows"] = $perRows;
        $data["pager"]  = $pager;
        $data["limit"]  = [
            "offset"    =>  $offset,
            "limit" =>  $perRows
        ];
        return $data;
    }

    /**
     * where条件处理
     * @param $query
     * @param array $condition
     * @return mixed
     */
    protected function goWhere($query,$condition=[]){
        if($condition){
            foreach ($condition as $k => $v){
                if(count($v) > 2){
                    $keyword = strtoupper(trim($v[1]));
                    if($keyword == "IN"){
                        $query = $query->whereIn($v[0],$v[2]);
                        unset($condition[$k]);
                    }elseif ($keyword == "NOT IN"){
                        $query = $query->whereNotIN($v[0],$v[2]);
                        unset($condition[$k]);
                    }elseif ($keyword == "BETWEEN"){
                        $query = $query->whereBetween($v[0],$v[2]);
                        unset($condition[$k]);
                    }elseif($keyword == "NOT BETWEEN"){
                        $query = $query->whereNotBetween($v[0],$v[2]);
                        unset($condition[$k]);
                    }
                }
            }
        }

        return $query->where($condition);
    }
}