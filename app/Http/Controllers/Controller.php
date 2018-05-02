<?php

namespace App\Http\Controllers;

use App\Services\RedisService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $RedisService;
    public function __construct()
    {
        $this->RedisService = new RedisService();
        if(method_exists($this,"_init")){
            $this->_init();
        }
        if(config("app.env") != "prodution"){
            $this->_dbListener();
        }
    }

    /**
     * 重写视图显示方法
     * @param $template
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($template=null,$data=[],$mergeData=[]){

        $moduleName = lcfirst($this->getModuleName());
        $theme = $moduleName.".".config($moduleName.".view.theme");
        if(!$template){
            $currentControllerName = lcfirst($this->getCurrentControllerName());
            $actionName = lcfirst($this->getCurrentMethodName());
            $template = $theme.".".$currentControllerName.".".$actionName;
        }else{
            $template = $theme.".".$template;
        }
        $template = trim($template,'.');
        return view($template,$data,$mergeData);
    }

    /**
     * 返回
     */
    protected function responseJson($status,$msg="",$data = []){
        $content["status"] = $status;
        $content["msg"] = $msg;
        $content["data"] = $data;
        return response()->json($content,200);
    }

    /**
     * 获取当前控制器名
     *
     * @return string
     */
    public function getCurrentControllerName()
    {
        return str_replace("Controller","",strrev(explode("\\",strrev($this->getRealControllerName()))[0]));
    }

    public function getRealControllerName(){
        return $this->getCurrentAction()['controller'];
    }
    /**
     * 获取当前方法名
     *
     * @return string
     */
    public function getCurrentMethodName()
    {
        return $this->getCurrentAction()['method'];
    }

    /**
     * 获取模块名称
     */
    public function getModuleName(){
        return explode('\\',str_replace("App\\Http\\Controllers\\","",$this->getRealControllerName()))[0];
    }
    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }

    /**
     * 数据库操作监听
     */
    protected function _dbListener(){
        DB::listen(
            function ($sql) {
                // $sql is an object with the properties:
                //  sql: The query
                //  bindings: the sql query variables
                //  time: The execution time for the query
                //  connectionName: The name of the connection

                // To save the executed queries to file:
                // Process the sql and the bindings:
                foreach ($sql->bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if (is_string($binding)) {
                            $sql->bindings[$i] = "'$binding'";
                        }
                    }
                }

                // Insert bindings into query
                $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);

                $query = vsprintf($query, $sql->bindings);

                // Save the query to file
                $logFile = fopen(
                    storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'),
                    'a+'
                );
                fwrite($logFile, date('Y-m-d H:i:s') . ': ' . $query . PHP_EOL);
                fclose($logFile);
            });
    }

    /**
     * 成功跳转
     * @param $msg
     * @param $returnUri
     * @param int $jumpSecond
     * @param string $jumpTpl
     */
    protected function success($msg,$jumpUri=null,$jumpTime=3){
        $data["return_url"] = $jumpUri?$jumpUri:back()->getTargetUrl();
        $data["time"] = $jumpTime;
        $data["msg"] = $msg;
        return redirect("/success/?".http_build_query($data));
    }

    /**
     * 失败跳转
     */
    protected function error($msg,$jumpUri=null,$jumpTime=3){
        $data["return_url"] = $jumpUri?$jumpUri:back()->getTargetUrl();
        $data["time"] = $jumpTime;
        $data["msg"] = $msg;
        return redirect("/error/?".http_build_query($data));
    }

}
