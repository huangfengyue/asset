<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/14
 * Time: 15:17
 */

namespace App\Http\Controllers\Assetor;


use App\Http\Controllers\Assetor\Base\BaseController;
use Illuminate\Http\Request;

class WelcomeController extends BaseController
{
    public function index(Request $request){
        return $this->view();
    }
}