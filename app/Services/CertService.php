<?php
/**
 * Created by PhpStorm.
 * User: Jinping<jinping_125@qq.com>
 * Date: 2017/3/9
 * Time: 17:00
 */

namespace App\Services;


use App\Models\ApplyCert;
use App\Models\Enlist;

class CertService extends BaseService
{
    private $CertType;
    private $Cert;
    public function __construct()
    {
        parent::__construct();
        $this->CertType = new Enlist();
        $this->Cert = new ApplyCert();
    }

    /**
     * 获取证件类型列表
     */
    public function getTypeItem(){
        return $this->CertType->where("status",Enlist::$STATUS_ENABLE)
            ->get();
    }

    /**
     * 获取证件类型压缩包
     */
    public function getTypeZip(){
        return $this->CertType->where("type_id",13)
            ->get();
    }


    /**
     * 保存证书集合
     */
    public function saveCertItem($data,$apply_id){
        foreach ($data as $k => $v){
            $data[$k]["apply_id"] = $apply_id;
        }
        return $this->Cert->insert($data);
    }

    /**
     * 跟类型ID获取类型名
     */
    public function getTypeNameByTypeId($type_id){
        return $this->CertType->where("type_id",$type_id)
            ->value("type_name");
    }

    /**
     * 根据类型ID获取类型信息
     */
    public function getCertInfoByTypeId($type_id){
        return $this->CertType->where("type_id",$type_id)
            ->first();
    }

    /**
     * 根据申请单ID和证件类型ID删除多个证件
     */
    public function deleteApplyCertItemByTypeId($type_id,$apply_id){
        $condition = [
            ["type_id",$type_id],
            ["apply_id",$apply_id]
        ];
        $u["status"] = ApplyCert::$STATUS_DELETE;
        $u["update_time"] = time();
        return $this->Cert->where($condition)->update($u);
    }
}