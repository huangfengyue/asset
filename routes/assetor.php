<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:09
 */
Route::group(["prefix"=>"asset"],function (){
    Route::get("/{get?}","AssetController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::any("/{apply_id}","AssetController@detail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/cert","AssetController@certDetail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/ck2-info","AssetController@ck2Info")->where("apply_id",'\d+$');  //二审信息
    Route::match(["post","get"],"/{apply_id}/sign","AssetController@sign")->where("apply_id",'^\d+$');   //资产一审签约
    Route::match(["post","get"],"/{apply_id}/check1","AssetController@check1")->where("apply_id",'^\d+$');   //资产一审
    Route::match(["post","get"],"check2/{get?}","AssetController@listByCheck2")->where("get",'^(\?\S*)|(\S{0})$');//二审列表
    Route::match(["post","get"],"/{apply_id}/check2","AssetController@check2")->where("apply_id",'^\d+$');;   //资产二审详细
    Route::match(["post","get"],"details/{apply_id}","AssetController@details")->where("apply_id",'^\d+$');
    Route::match(["post","get"],'list_excel','AssetController@list_excel');
    Route::match(["post","get"],'ck2_excel','AssetController@ck2_excel');
    Route::get("/{apply_id}/jlx","AssetController@jlx")->where("apply_id",'^\d+$');
    Route::get("/repay/{get?}","AssetController@repay")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],"caiwu/{apply_id}","AssetController@caiwu")->where("apply_id",'^\d+$');
    for($i=1;$i<6;$i++){
        Route::match(["post","get"],"details_{$i}/{apply_id}","AssetController@details_{$i}")->where("apply_id",'^\d+$');
    }
});
Route::group(["prefix"=>"repay"],function (){
    Route::get("/{get?}","RepayController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],'repay_excel','RepayController@repay_excel');
});
Route::get("/","WelcomeController@index");