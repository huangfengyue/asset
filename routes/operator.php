<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:07
 */
Route::group(["prefix"=>"asset"],function (){
    Route::get("/{get?}","AssetController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::get("/{apply_id}","AssetController@detail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/cert","AssetController@certDetail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/ck2-info","AssetController@ck2Info")->where("apply_id",'\d+$');  //二审信息
    Route::post("/{apply_id}/publish","AssetController@publish")->where("apply_id",'^\d+$');    //发标
    Route::post("/{apply_id}/full","AssetController@full")->where("apply_id",'^\d+$');  //满标
    Route::match(["post","get"],"details/{apply_id}","AssetController@details")->where("apply_id",'^\d+$');
    for($i=1;$i<6;$i++){
        Route::match(["post","get"],"details_{$i}/{apply_id}","AssetController@details_{$i}")->where("apply_id",'^\d+$');
    }
});
Route::group(["prefix"=>"repay"],function (){
    Route::get("/{get?}","RepayController@lists")->where("get",'^(\?\S*)|(\S{0})$');
});
Route::get("/","WelcomeController@index");