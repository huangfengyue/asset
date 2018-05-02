<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 17:31
 */
Route::group(["prefix"=>"user"],function (){
   Route::any("/{get?}","UserController@huijiLists")->where("get",'^(\?\S*)|(\S{0})$');
  //  Route::any("/{get?}","dummyLists","UserController@dummyLists")->where("get",'^(\?\S*)|(\S{0})$');
   // Route::match(["post","get"],"UserController@huijiLists")->where("id",'^\d+$');
    Route::match(["post","get"],"enlist","UserController@enlist");
    Route::match(["post","get"],"dummyLists","UserController@dummyLists");
    Route::match(["post","get"],"/{user_id}/update","UserController@update")->where("user_id",'^\d+$');
 //   Route::match(["post","get"],"lists/{id}","UserController@lists")->where("id",'^\d+$');;

    Route::post("/{apply_id}/del","UserController@delete")->where("apply_id",'^\d+$');
});
Route::group(["prefix"=>"user-role"],function (){
    Route::get("/{get?}","RoleController@lists")->where("get",'^(\?\S*)|(\S{0})$');
    Route::get("/{role_id}","RoleController@detail")->where("role_id",'^\d+$');
});
Route::get("/","WelcomeController@index");