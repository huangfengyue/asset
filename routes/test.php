<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:09
 */
Route::group(["prefix"  =>  "asset"],function (){ //echo 66;exit;
    Route::match(["post","get"],"/{apply_id}/sign","AssetController@sign")->where("apply_id",'^\d+$');   //签约
    Route::match(["post","get"],"lists/{id}","AssetController@lists")->where("id",'^\d+$');;
    Route::match(["post","get"],"loan_category","AssetController@loan_category");

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