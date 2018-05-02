<?php
/**
 * Created by PhpStorm.
 * User: jinping<jinping_125@qq.com>
 * Date: 2017/3/6
 * Time: 11:28
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * where条件处理
     * @param $query
     * @param array $condition
     * @return mixed
     */
    public function goWhere($condition=[]){
        $query = $this;
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