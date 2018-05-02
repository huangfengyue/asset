<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/12
 * Time: 21:06
 */

namespace App\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OssServices extends BaseService
{
    public static $ossImgPath = "images/";
    public static $ossVideoPath = "video/";
    public static $ossZipPath = "zip/";
    public static function putImg(UploadedFile $resource){
        $mimeType = strtolower($resource->getMimeType());
        switch ($mimeType){
            case 'image/png':$postFix = ".png";break;
            case 'image/jpg':$postFix = ".jpg";break;
            case 'image/jpeg':$postFix = ".jpeg";break;
            case 'image/gif':$postFix = ".gif";break;
            default:$postFix = ".png";
        }
        $randItem = date("His")."0123456789abcdefghijklmnopqrstuvwxyz";
        $randName = md5(str_shuffle($randItem));
        $randName = date("Y-m-d")."/".$randName.$postFix;
        if(Storage::put(OssServices::$ossImgPath.$randName,file_get_contents($resource->getPathname()))){
            return OssServices::$ossImgPath.$randName;
        }else{
            return false;
        }
    }

    /**
     * 存储视频
     * @param UploadedFile $resource
     *
     * @return bool|string
     */
    public static function putVideo(UploadedFile $resource){
        $extNameItem = explode(".",strrev($resource->getClientOriginalName()));
        $extName = ".".strrev($extNameItem[0]);
        $randItem = date("His")."0123456789abcdefghijklmnopqrstuvwxyz";
        $randName = md5(str_shuffle($randItem));
        $randName = date("Y-m-d")."/".$randName.$extName;
        if(Storage::put(OssServices::$ossVideoPath.$randName,file_get_contents($resource->getPathname()))){
            return OssServices::$ossVideoPath.$randName;
        }else{
            return false;
        }
    }

    /**
     * 存储压缩包
     * @param UploadedFile $resource
     * @return bool|string
     */
    public static function putZip(UploadedFile $resource){
        $extNameItem = explode(".",strrev($resource->getClientOriginalName()));
        $extName = ".".strrev($extNameItem[0]);
        $randItem = date("His")."0123456789abcdefghijklmnopqrstuvwxyz";
        $randName = md5(str_shuffle($randItem));
        $randName = date("Y-m-d")."/".$randName.$extName;
        if(Storage::put(OssServices::$ossZipPath.$randName,file_get_contents($resource->getPathname()))){
            return OssServices::$ossZipPath.$randName;
        }else{
            return false;
        }
    }
}