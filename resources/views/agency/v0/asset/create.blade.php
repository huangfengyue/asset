@extends("agency.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/create.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>发起新申请</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/agency">首页</a>
                </li>
                <li>
                    <a href="/agency/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>发起申请</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>发起新申请</h5>
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

                        <form method="post" action="/agency/asset/create" class="form-horizontal layui-form">
                            <h5>您的个人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_name" lay-verify="applier_name" placeholder="请填写申请人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">年龄</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_age" lay-verify="applier_age" placeholder="请填写申请人年龄">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-10">
                                        <select name="applier_sex">
                                            <option value="0">男</option>
                                            <option value="1">女</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">学历</label>
                                    <div class="col-sm-10">
                                        <select name="applier_education">
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
                                        <select name="applier_marriage">
                                            <option value="0">未婚</option>
                                            <option value="1">已婚</option>
                                            <option value="2">离异</option>
                                            <option value="3">再婚</option>
                                            <option value="4">其他</option>
                                        </select>  </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_mobile" lay-verify="applier_mobile" placeholder="请填写申请人手机号码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_idcard" lay-verify="applier_idcard" placeholder="请填写18位身份证号码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">供养人数</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="support_people" lay-verify="support_people" placeholder="请填写供养人数">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">子女数目</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="childs" lay-verify="childs" placeholder="请填写子女数目">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">户籍地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="origin_address" lay-verify="origin_address" placeholder="请填写详细地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">房产状况</label>
                                    <div class="col-sm-10">
                                        <select name="house">
                                            <option value="0">亲属产权</option>
                                            <option value="1">自建房</option>
                                            <option value="2">无按揭房产</option>
                                            <option value="3">按揭房产</option>
                                            <option value="4">单位宿舍</option>
                                            <option value="5">租房</option>
                                        </select>    </div>
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
                                        <input type="text" class="form-control" name="applier_address" lay-verify="applier_address" placeholder="请填写详细地址">
                                    </div>
                                </div>


                            </div>

                            <h5>您的职业信息(选填)</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位全称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_company" lay-verify="applier_company" placeholder="请填写申请人单位全称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company_address" lay-verify="company_address" placeholder="请填写申请人单位地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company_phone" lay-verify="company_phone" placeholder="请填写申请人单位电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">职位</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_job" lay-verify="applier_job" placeholder="请填写申请人单位职位">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属行业</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="business" lay-verify="business" placeholder="请填写申请人所属行业">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">工作性质</label>
                                    <div class="col-sm-10">
                                        <select name="job_character">
                                            <option value="0">自雇</option>
                                            <option value="1">管理人员</option>
                                            <option value="2">正式职员</option>
                                            <option value="3">合同制</option>
                                            <option value="4">其他</option>
                                        </select>      </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属行业</label>
                                    <div class="col-sm-10">
                                        <select name="company_character">
                                            <option value="0">政府机构</option>
                                            <option value="1">事业单位</option>
                                            <option value="2">民营</option>
                                            <option value="3">外资/合资</option>
                                            <option value="4">国有企业</option>
                                            <option value="5">社会团体</option>
                                        </select>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">月基本工资</label>
                                    <div class="col-sm-10">
                                        月基本工资 <input type="text" class="form-control" name="applier_salary" lay-verify="applier_salary" value="0" placeholder="请填写申请人月基本工资">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">月发薪日</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="salary_day" lay-verify="salary_day" placeholder="请填写申请人月发薪日">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" lay-filter="next" lay-submit type="button">下一步</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection