<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 17:35
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Base\BaseController;

class WelcomeController extends BaseController
{
    public function index(){
        return $this->view();
    }
}