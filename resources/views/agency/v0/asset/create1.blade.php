@extends("agency.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/create1.js')}}"></script>
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
                        <form method="post" action="/agency/asset/create1" class="form-horizontal layui-form">
                            <h5>您的第一位直系亲属联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_name" lay-verify="relative_name" placeholder="请填写申请人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="applier_relative">
                                            <option value="0">父母</option>
                                            <option value="1">配偶</option>
                                            <option value="2">子女</option>
                                        </select>  </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位名称(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company" lay-verify="relative_company" placeholder="请填写关系人单位名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">座机(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_call" lay-verify="relative_call" placeholder="请填写关系人座机(如：021-64524325)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_phone" lay-verify="relative_phone" placeholder="请填写关系人手机">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家人是否知晓</label>
                                    <div class="col-sm-10">
                                        <select name="relative_notice">
                                            <option value="0">否</option>
                                            <option value="1">是</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_address" lay-verify="relative_address" placeholder="请填写关系人家庭地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company_address" lay-verify="relative_company_address" placeholder="请填写关系人单位地址">
                                    </div>
                                </div>

                                </div>
                            <h5>您的第二位直系亲属联系人信息(选填)</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_name1" lay-verify="relative_name1" placeholder="请填写申请人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="applier_relative1">
                                            <option value="0">父母</option>
                                            <option value="1">配偶</option>
                                            <option value="2">子女</option>
                                        </select>  </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位名称(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company1" lay-verify="relative_company1" placeholder="请填写关系人单位名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">座机(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_call1" lay-verify="relative_call1" placeholder="请填写关系人座机(如：021-64524325)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_phone1" lay-verify="relative_phone1" placeholder="请填写关系人手机">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_address1" lay-verify="relative_address1" placeholder="请填写关系人家庭地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="relative_company_address1" lay-verify="relative_company_address1" placeholder="请填写关系人单位地址">
                                    </div>
                                </div>
                            </div>
                            <h5>您的紧急联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_name" lay-verify="emergency_name" placeholder="请填写紧急联系人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="emergency_relative">
                                            <option value="0">同事</option>
                                            <option value="1">朋友</option>
                                            <option value="2">亲属</option>
                                            <option value="3">其他</option>
                                        </select>   </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_company" lay-verify="emergency_company" placeholder="请填写紧急联系人单位名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">座机(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_call" lay-verify="emergency_call" placeholder="请填写紧急联系人座机(如：021-64524325)">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_phone" lay-verify="emergency_phone" placeholder="请填写紧急联系人手机">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_address" lay-verify="emergency_address" placeholder="请填写紧急联系人家庭地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位地址(选填)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emergency_company_address" lay-verify="emergency_company_address" placeholder="请填写紧急联系人单位地址">
                                    </div>
                                </div>
                            </div>
                            <h5>您的同事联系人信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_name" lay-verify="colleague_name" placeholder="请填写紧急联系人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关系</label>
                                    <div class="col-sm-10">
                                        <select name="colleague_relative">
                                            <option value="0">同事</option>
                                            <option value="1">领导</option>
                                            <option value="2">下属</option>
                                            <option value="3">其他</option>
                                        </select>   </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">座机(选填)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="colleague_call" lay-verify="colleague_call" placeholder="请填写紧急联系人座机(如：021-64524325)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_phone" lay-verify="colleague_phone" placeholder="请填写紧急联系人手机">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">家庭地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="colleague_address" lay-verify="colleague_address" placeholder="请填写紧急联系人家庭地址">
                                    </div>
                                </div>
                            </div>
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