@extends("agency.v0.layouts.default")
@section("title","修改资产申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/updateApply.js')}}"></script>
    <script>
        $(function () {
            $(".applier_education").find("option[value='{{$applyInfo->applier_education}}']").prop("selected",true)
        })
    </script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>修改申请</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/agency">首页</a>
                </li>
                <li>
                    <a href="/agency/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>修改申请</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="/agency/asset/{{$applyInfo->apply_id}}/update-cert" class="btn btn-info">修改证件信息</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改基本信息</h5>
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
                        <form name="form" method="post" action="/agency/asset/{{$applyInfo->apply_id}}/update" class="form-horizontal layui-form">
                            <h5>您的个人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_name" lay-verify="applier_name" value="{{$applyInfo->applier_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">年龄</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_age" lay-verify="applier_age" value="{{$applyInfo->applier_age}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-10">
                                        <select name="applier_sex" class="applier_sex">
                                            <option value="0">男</option>
                                            <option value="1">女</option>
                                        </select>
                                        <script> $(".applier_sex").find("option[value='{{$applyInfo->applier_sex}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">学历</label>
                                    <div class="col-sm-10">
                                        <select name="applier_education" class="applier_education">
                                            <option value="0">硕士及以上</option>
                                            <option value="1">本科</option>
                                            <option value="2">大专</option>
                                            <option value="3">中专</option>
                                            <option value="4">高中及以下</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">婚姻状况</label>
                                    <div class="col-sm-10">
                                        <select name="applier_marriage" class="applier_education">
                                            <option value="0">未婚</option>
                                            <option value="1">已婚</option>
                                            <option value="2">离异</option>
                                            <option value="3">再婚</option>
                                            <option value="4">其他</option>
                                        </select>
                                        <script> $(".applier_education").find("option[value='{{$applyInfo->applier_marriage}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_mobile" lay-verify="applier_mobile" value="{{$applyInfo->applier_mobile}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_idcard" lay-verify="applier_idcard" value="{{$applyInfo->applier_idcard}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">供养人数</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="support_people" lay-verify="support_people" value="{{$applyInfo->support_people}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">子女数目</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="childs" lay-verify="childs" value="{{$applyInfo->childs}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">户籍地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="origin_address" lay-verify="origin_address" value="{{$applyInfo->origin_address}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">房产状况</label>
                                    <div class="col-sm-10">
                                        <select name="house" class="selector">
                                            <option value="0">亲属产权</option>
                                            <option value="1" >自建房</option>
                                            <option value="2">无按揭房产</option>
                                            <option value="3">按揭房产</option>
                                            <option value="4">单位宿舍</option>
                                            <option value="5">租房</option>
                                        </select>
                                        <script> $(".selector").find("option[value='{{$applyInfo->house}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">如有按揭房产(选填)</label>
                                    <div class="col-sm-10">
                                        请填写房贷总期数<input type="text" class="form-control" name="house_apr" lay-verify="house_apr"  value="0" placeholder="请填写房贷总期数">
                                        请填写已还款期数 <input type="text" class="form-control" name="house_apr_yes" lay-verify="house_apr_yes" value="0" placeholder="请填写已还款期数">
                                        请填写月还款额 <input type="text" class="form-control" name="house_amt" lay-verify="house_amt"  value="0" placeholder="请填写月还款额">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">现住址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_address" lay-verify="applier_address" value="{{$applyInfo->applier_address}}">
                                    </div>
                                </div>


                            </div>

                            <h5>您的职业信息(选填)</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位全称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_company" lay-verify="applier_company" value="{{$applyInfo->applier_company}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company_address" lay-verify="company_address" value="{{$applyInfo->company_address}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company_phone" lay-verify="company_phone" value="{{$applyInfo->company_phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">职位</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_job" lay-verify="applier_job" value="{{$applyInfo->applier_job}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属行业</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="business" lay-verify="business" value="{{$applyInfo->business}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">工作性质</label>
                                    <div class="col-sm-10">
                                        <select name="job_character" class="job_character">
                                            <option value="0">自雇</option>
                                            <option value="1">管理人员</option>
                                            <option value="2">正式职员</option>
                                            <option value="3">合同制</option>
                                            <option value="4">其他</option>
                                        </select>
                                        <script> $(".job_character").find("option[value='{{$applyInfo->job_character}}']").attr("selected",true)</script>
                                    </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属行业</label>
                                    <div class="col-sm-10">
                                        <select name="company_character" class="company_character">
                                            <option value="0">政府机构</option>
                                            <option value="1">事业单位</option>
                                            <option value="2">民营</option>
                                            <option value="3">外资/合资</option>
                                            <option value="4">国有企业</option>
                                            <option value="5">社会团体</option>
                                        </select>
                                        <script> $(".company_character").find("option[value='{{$applyInfo->company_character}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">月基本工资</label>
                                    <div class="col-sm-10">
                                        月基本工资 <input type="text" class="form-control" name="applier_salary" lay-verify="applier_salary" value="0" value="{{$applyInfo->applier_salary}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">月发薪日</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="salary_day" lay-verify="salary_day" value="{{$applyInfo->salary_day}}">
                                    </div>
                                </div>
                            </div>
                            <h5>您的直系亲属联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_name" lay-verify="relative_name" value="{{$applyInfo->relative_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="applier_relative" class="applier_relative">
                                            <option value="0">父母</option>
                                            <option value="1">配偶</option>
                                            <option value="2">子女</option>
                                            <option value="3">其他</option>
                                        </select>
                                        <script> $(".applier_relative").find("option[value='{{$applyInfo->applier_relative}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company" lay-verify="relative_company" value="{{$applyInfo->relative_company}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">座机(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_call" lay-verify="relative_call" value="{{$applyInfo->relative_call}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_phone" lay-verify="relative_phone" value="{{$applyInfo->relative_phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家人是否知晓</label>
                                    <div class="col-sm-10">
                                        <select name="relative_notice" class="relative_notice">
                                            <option value="0">否</option>
                                            <option value="1">是</option>
                                        </select>
                                        <script> $(".relative_notice").find("option[value='{{$applyInfo->relative_notice}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_address" lay-verify="relative_address" value="{{$applyInfo->relative_address}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company_address" lay-verify="relative_company_address" value="{{$applyInfo->relative_company_address}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_name1" lay-verify="relative_name1" value="{{$applyInfo->relative_name1}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="applier_relative1" class="applier_relative1">
                                            <option value="0">父母</option>
                                            <option value="1">配偶</option>
                                            <option value="2">子女</option>
                                            <option value="3">其他</option>
                                        </select>
                                        <script> $(".applier_relative1").find("option[value='{{$applyInfo->applier_relative1}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company1" lay-verify="relative_company1" value="{{$applyInfo->relative_company1}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">座机(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_call1" lay-verify="relative_call1" value="{{$applyInfo->relative_call1}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_phone1" lay-verify="relative_phone1" value="{{$applyInfo->relative_phone1}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_address1" lay-verify="relative_address1" value="{{$applyInfo->relative_address1}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company_address1" lay-verify="relative_company_address1" value="{{$applyInfo->relative_company_address1}}">
                                    </div>
                                </div>
                            </div>
                            <h5>您的紧急联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_name" lay-verify="emergency_name" value="{{$applyInfo->emergency_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="emergency_relative" class="emergency_relative">
                                            <option value="0">同事</option>
                                            <option value="1">朋友</option>
                                            <option value="2">亲属</option>
                                            <option value="3">其他</option>
                                        </select>
                                        <script> $(".emergency_relative").find("option[value='{{$applyInfo->emergency_relative}}']").attr("selected",true)</script>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">单位名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="emergency_company" lay-verify="emergency_company" value="{{$applyInfo->emergency_company}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">座机(选填)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="emergency_call" lay-verify="emergency_call" value="{{$applyInfo->emergency_call}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_phone" lay-verify="emergency_phone" value="{{$applyInfo->emergency_phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_address" lay-verify="emergency_address" value="{{$applyInfo->emergency_address}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_company_address" lay-verify="emergency_company_address" value="{{$applyInfo->emergency_company_address}}">
                                    </div>
                                </div>
                            </div>
                            <h5>您的同事联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_name" lay-verify="colleague_name" value="{{$applyInfo->colleague_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="colleague_relative" class="colleague_relative">
                                            <option value="0">同事</option>
                                            <option value="1">领导</option>
                                            <option value="2">下属</option>
                                            <option value="3">其他</option>
                                        </select>
                                        <script> $(".colleague_relative").find("option[value='{{$applyInfo->colleague_relative}}']").attr("selected",true)</script>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">座机(选填)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="colleague_call" lay-verify="colleague_call" value="{{$applyInfo->colleague_call}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_phone" lay-verify="colleague_phone" value="{{$applyInfo->colleague_phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_address" lay-verify="colleague_address" value="{{$applyInfo->colleague_address}}">
                                    </div>
                                </div>
                            </div>
                            <h5>您的借款信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">借款用途</label>
                                    <div class="col-sm-10">
                                        <select name="applier_purpose" class="applier_purpose">
                                            <option value="0">资金周转</option>
                                            <option value="1">购物</option>
                                            <option value="2">教育</option>
                                            <option value="3">装修</option>
                                            <option value="4">旅游</option>
                                            <option value="5">扩大经营</option>
                                            <option value="6">医疗</option>
                                            <option value="7">其他</option>
                                        </select>
                                        <script> $(".applier_purpose").find("option[value='{{$applyInfo->applier_purpose}}']").attr("selected",true)</script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">银行卡号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bankcard_no" lay-verify="bankcard_no" value="{{$applyInfo->bankcard_no}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属银行</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bankcard_type" lay-verify="bankcard_type" value="{{$applyInfo->bankcard_type}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">您希望申请的金额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="apply_amt" lay-verify="apply_amt" value="{{$applyInfo->apply_amt}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">您可接受每周最高还款金额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_week_amt" lay-verify="applier_week_amt" value="{{$applyInfo->applier_week_amt}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">借款期限</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="deadline" lay-verify="deadline" value="{{$applyInfo->deadline}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">期限单位</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="deadline_type" value="1" title="天" >
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="deadline_type" value="2" title="月">
                                        </label>
                                        <script> $(".radio-inline").find("input[value='{{$applyInfo->deadline_type}}']").attr("checked",true)</script>
                                    </div>
                                </div>
                            </div>

                            <h5>工作人员</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">客户经理</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="survey_name" lay-verify="survey_name" value="{{$applyInfo->survey_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="survey_phone" lay-verify="survey_phone" value="{{$applyInfo->survey_phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/agency/asset">返回</a>
                                    <button class="btn btn-primary" lay-filter="save" lay-submit type="button">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection