<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/8
 * Time: 9:51
 */

namespace App\Services;


use Illuminate\Support\Facades\Redis;

class RedisService
{

    /**
     * 获取
     * @param $key
     * @return mixed
     */
    public static function get($key){
        return Redis::get($key);
    }

    /**
     * 设置
     */
    public static function set($key,$value,$expire=0){
        if(is_array($value) || is_object($value)){
            $value = json_encode($value,JSON_UNESCAPED_UNICODE);
        }

        $r = Redis::set($key,$value);
        if($r){
            if($expire){
                Redis::expire($key,$expire);
            }
            return $r;
        }else{
            return $r;
        }
    }

    /**
     * 删除对象
     */
    public function del($key){
        return Redis::exists($key)?Redis::del($key):true;
    }
}