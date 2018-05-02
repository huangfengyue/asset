<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:09
 */
Route::group(["prefix"  =>  "asset"],function (){
    Route::any("create/upzip","AssetController@createUpZip");
    Route::get("/{apply_id}/cert","AssetController@certDetail")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/ck2-info","AssetController@ck2Info")->where("apply_id",'\d+$');  //二审信息
    Route::match(["post","get"],"/{apply_id}/update","AssetController@updateApply")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"/{apply_id}/update/{type_id}","AssetController@updateApplyCertByTypeId")->where("apply_id",'^\d+$')
        ->where("type_id",'^\d+$');
    Route::post("/{apply_id}/del","AssetController@delete")->where("apply_id",'^\d+$');
    Route::match(["post","get"],'list_excel','AssetController@list_excel');
    Route::match(["post","get"],'ck2_excel','AssetController@ck2_excel');
    Route::match(["post","get"],'repay_excel','AssetController@repay_excel');
    Route::match(["post","get"],"/{apply_id}/update-cert","AssetController@updateApplyCert")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"/{apply_id}/update-complet","AssetController@updateComplet");
    Route::get("/{apply_id}","AssetController@detail")->where("apply_id",'^\d+$');
    Route::any("/{get?}","AssetController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::get("/{apply_id}/jlx","AssetController@jlx")->where("apply_id",'^\d+$');
    Route::get("/{apply_id}/face_detail","AssetController@face_detail")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"check2/{get?}","AssetController@listByCheck2")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],"/{apply_id}/complet","AssetController@complet")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"details/{apply_id}","AssetController@details")->where("apply_id",'^\d+$');
    Route::any("/repay/{get?}","AssetController@repay")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],"caiwu/{apply_id}","AssetController@caiwu")->where("apply_id",'^\d+$');
    Route::match(["post","get"],"repayment/{apply_id}","AssetController@repayment")->where("apply_id",'^\d+$');
    for($i=1;$i<6;$i++){
        Route::match(["post","get"],"details_{$i}/{apply_id}","AssetController@details_{$i}")->where("apply_id",'^\d+$');
   }
});

Route::group(["prefix"=>"repay"],function (){
    Route::any("/{get?}","RepayController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],'repay_excel','RepayController@repay_excel');
});

Route::group(["prefix"=>"test"],function (){
    Route::get("/{get?}","TestController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::match(["post","get"],'repay_excel','RepayController@repay_excel');
});
Route::get("/","WelcomeController@index");