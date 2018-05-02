<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/5
 * Time: 10:20
 */

namespace App\Http\Controllers\Agency;


use App\Http\Controllers\Agency\Base\BaseController;
use Illuminate\Http\Request;

class WelcomeController extends BaseController
{
    public function index(){
        return $this->view();
    }
}