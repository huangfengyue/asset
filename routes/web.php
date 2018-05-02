<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * B端综合管理系统
 */
//Route::group(["domain"  =>  preg_replace('/^http(s?):\/\//i',"",config("domain.asset"))],function (){
   // Route::group(["middleware"  =>  ["user.login"]],function (){
        Route::get("loginout","Common\\LoginController@loginout");
        //管理员
        Route::group(["prefix"  =>  "admin","middleware"   =>  ["admin.basic"],"namespace"  =>  "Admin"],function (){
            require __DIR__."/admin.php";
        });
        //经销
        Route::group(["prefix"  =>  "agency","middleware"=>["agency.basic"],"namespace"=>"Agency"],function (){
            require __DIR__ . "/agency.php";
        });
        //初审
        Route::group(["prefix"  =>  "chushen","middleware"=>["chushen.basic"],"namespace"=>"Chushen"],function (){
            require __DIR__ . "/chushen.php";
        });
        //复审
        Route::group(["prefix"  =>  "fushen","middleware"=>["fushen.basic"],"namespace"=>"Fushen"],function (){
            require __DIR__ . "/fushen.php";
        });
        //终审
        Route::group(["prefix"  =>  "zhongshen","middleware"=>["zhongshen.basic"],"namespace"=>"Zhongshen"],function (){
            require __DIR__ . "/zhongshen.php";
        });
        //财务
        Route::group(["prefix"  =>  "financer","middleware" =>  ["financer.basic"],"namespace"=>"Financer"],function (){
            require __DIR__."/financer.php";
        });
        //测试
        Route::group(["prefix"  =>  "test","middleware" =>  ["test.basic"],"namespace"=>"Test"],function (){
            require __DIR__."/test.php";
        });
        Route::get("/","Common\\WelcomeController@index");
   // });



    Route::group(["namespace"   =>  "Common"],function (){
        Route::match(["post","get"],"login","LoginController@index");
        Route::match(["post","get"],"newpwd","LoginController@newpwd");
        Route::get("success/{get?}","JumpController@ok")->where("get",'^(\?\S*)|(\S{0})$');
        Route::get("error/{get?}","JumpController@fail");
    });
//});