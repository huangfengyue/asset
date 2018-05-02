<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 13:51
 */

namespace App\Http\Controllers\Financer;


use App\Http\Controllers\Financer\Base\BaseController;

class WelcomeController extends BaseController
{
    public function index(){
        return $this->view();
    }
}