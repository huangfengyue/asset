<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/14
 * Time: 17:46
 */

namespace App\Http\Controllers\Riskctl;


use App\Http\Controllers\Riskctl\Base\BaseController;

class WelcomeController extends BaseController
{
    public function index(){
        return $this->view();
    }
}