<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:18
 */
Route::group(["prefix"=>"asset"],function (){
    Route::get("/{apply_id}","AssetController@detail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/cert","AssetController@certDetail")->where("apply_id",'^\d+$'); //证件信息
    Route::get("/{apply_id}/ck2-info","AssetController@ck2Info")->where("apply_id",'\d+$');  //二审信息
    Route::any("/{get?}","AssetController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],"/{apply_id}/finish-loan","AssetController@finishLoan")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"/{apply_id}/repay","AssetController@repay")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"/{repay_id}/repays","AssetController@repays")->where("repay_id",'^\d+$');
    Route::match(["post","get"],"caiwu/{apply_id}","AssetController@caiwu")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"details/{apply_id}","AssetController@details")->where("apply_id",'^\d+$');
    Route::match(["post","get"],'list_excel','AssetController@list_excel');
    Route::match(["post","get"],'ck2_excel','AssetController@ck2_excel');
    for($i=1;$i<6;$i++){
        Route::match(["post","get"],"details_{$i}/{apply_id}","AssetController@details_{$i}")->where("apply_id",'^\d+$');
    }
});
Route::group(["prefix"=>"repay"],function (){
    Route::any("/{get?}","RepayController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],'repay_excel','RepayController@repay_excel');
    Route::match(["post","get"],'repay_update','RepayController@repay_update');
});
Route::get("/","WelcomeController@index");