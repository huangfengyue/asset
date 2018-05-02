@extends("financer.v0.layouts.default")
@section("title","查看申请详情")
@section("head")

@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>查看申请详情</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/financer">首页</a>
                </li>
                <li>
                    <a href="/financer/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>申请详情</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="/financer/asset/{{$applyInfo->apply_id}}/cert" class="btn btn-info">证件资料压缩包</a>
                <a href="/financer/asset/{{$applyInfo->apply_id}}/ck2-info" class="btn btn-info">借款合同压缩包</a>

            </div>

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本信息</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <h5>借款人基本信息</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">借款人姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款人性别</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_sex}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款人身份证号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_idcard}}@if($applyInfo["flag"]==1)(该身份证已经有借款记录)@endif</p>

                                </div>
                                <label class="col-sm-2 control-label">借款人手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_mobile}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款金额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">银行卡号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->bankcard_no}}</p>
                                </div>
                                <label class="col-sm-2 control-label">户籍地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->origin_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">现住址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">婚姻状况</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_marriage}}</p>
                                </div>
                                <label class="col-sm-2 control-label">学历</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_education}}</p>
                                </div>
                                <label class="col-sm-2 control-label">供养人数</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->support_people}}</p>
                                </div>
                                <label class="col-sm-2 control-label">子女数目</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->childs}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位全称</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_company}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->company_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位电话</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->company_phone}}</p>
                                </div>
                                <label class="col-sm-2 control-label">职位</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_job}}</p>
                                </div>
                                <label class="col-sm-2 control-label">所属行业</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->business}}</p>
                                </div>
                                <label class="col-sm-2 control-label">工作性质</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->job_character}}</p>
                                </div>
                                <label class="col-sm-2 control-label">所属行业</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->company_character}}</p>
                                </div>
                                <label class="col-sm-2 control-label">月基本工资</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_salary}}</p>
                                </div>
                                <label class="col-sm-2 control-label">月发薪日</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->salary_day}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <h5>借款人直系亲属基本信息</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">直系亲属姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">关系</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_relative}}</p>
                                </div>
                                <label class="col-sm-2 control-label">直系亲属手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_phone}}@if($applyInfo["flag1"]==1)(该直系亲属已经有借款记录)@endif</p>
                                </div>
                                <label class="col-sm-2 control-label">座机(选填)</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_call}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位名称</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_company}}</p>
                                </div>
                                <label class="col-sm-2 control-label">家庭地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_company_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">直系亲属姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_name1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">关系</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_relative1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">直系亲属手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_phone1}}@if($applyInfo["flag2"]==1)(该直系亲属已经有借款记录)@endif</p>
                                </div>
                                <label class="col-sm-2 control-label">座机(选填)</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_call1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位名称</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_company1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">家庭地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_address1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_company_address1}}</p>
                                </div>
                                <label class="col-sm-2 control-label">家人是否知晓</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->relative_notice}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <h5>借款人紧急联系人基本信息</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">紧急联系人姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">关系</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_relative}}</p>
                                </div>
                                <label class="col-sm-2 control-label">紧急联系人手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_phone}}@if($applyInfo["flag3"]==1)(该紧急联系人已经有借款记录)@endif</p>
                                </div>
                                <label class="col-sm-2 control-label">座机(选填)</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_call}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位名称</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_company}}</p>
                                </div>
                                <label class="col-sm-2 control-label">家庭地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_address}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->emergency_company_address}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <h5>借款人同事联系人基本信息</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">同事联系人姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">关系</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_relative}}</p>
                                </div>
                                <label class="col-sm-2 control-label">同事联系人手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_phone}}@if($applyInfo["flag4"]==1)(该同事联系人已经有借款记录)@endif</p>
                                </div>
                                <label class="col-sm-2 control-label">座机(选填)</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_call}}</p>
                                </div>
                                <label class="col-sm-2 control-label">单位名称</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_company}}</p>
                                </div>
                                <label class="col-sm-2 control-label">家庭地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->colleague_address}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <h5>客户经理</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户经理姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->survey_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->survey_phone}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->status_name}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">最初提交时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{date("Y-m-d H:i",$applyInfo->create_time)}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发起人备注信息</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">初审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->chushen_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">复审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->fushen_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">终审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->zhongshen_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">资产一审实际放款</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">@if($applyInfo["apply_amt_final"]==0.00)--@else{{$applyInfo->apply_amt_final}}@endif</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection