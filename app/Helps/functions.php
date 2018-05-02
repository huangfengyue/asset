<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/6
 * Time: 11:37
 */
//正则验证
if(!function_exists("regexValidate")){
    function regexValidate($field,$content){
        $item = [
            "username" => '/^[a-z\_\d]{4,30}$/',   //用户名
            "password" => '/^\S{6,15}$/',  //密码
            "mobile" => '/^1[34578]{1}\d{9}$/', //手机号
            "email" => '/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/', //邮箱
            "bankcard_no"   =>  '/^[1-9]\d{15,18}$/',
            "idcard"    =>  '/^[1-9]{1}\d{5}[12]{1}[0-9]{3}\d{7}[\dx]{1}$/i',
        ];

        if(isset($item[$field]) && preg_match($item[$field],$content)){
            return true;
        }else{
            return false;
        }
    }
}

//密码加密
if(!function_exists("passwordEncrypt")){
    function passwordEncrypt($password){
        $salt = config("app.passwordSalt","passwordSalt");
        return md5(md5($password).md5($salt));
    }
}

//获取oss图片地址
if(!function_exists("getOssImgUri")){
    function getOssImgUri($key){
        $domain = config("domain.ossImgDomain");
        return $domain."/".$key;
    }
}


//获取下载地址
if(!function_exists("getDlName")){
    function getDlName($fileName){
        $postFix = ".".strrev(explode(".",strrev($fileName))[0]);
        return md5($fileName).$postFix;
    }
}

//获取资料压缩包链接
if(!function_exists("getOssZipUri")){
    function getOssZipUri($key){
        $domain = config("domain.ossZipDomain");
        return $domain."/".$key;
    }
}
function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}