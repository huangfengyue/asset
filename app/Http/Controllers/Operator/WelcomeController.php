<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/15
 * Time: 11:13
 */

namespace App\Http\Controllers\Operator;


use App\Http\Controllers\Operator\Base\BaseController;

class WelcomeController extends BaseController
{
    public function index(){
        return $this->view();
    }
}