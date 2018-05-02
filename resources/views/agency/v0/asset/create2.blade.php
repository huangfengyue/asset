@extends("agency.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/create2.js')}}"></script>
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
                        <form method="post" action="/agency/asset/create2" class="form-horizontal layui-form">
                            <h5>您的借款信息</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">借款用途</label>
                                    <div class="col-sm-10">
                                        <select name="applier_purpose">
                                            <option value="0">资金周转</option>
                                            <option value="1">购物</option>
                                            <option value="2">教育</option>
                                            <option value="3">装修</option>
                                            <option value="4">旅游</option>
                                            <option value="5">扩大经营</option>
                                            <option value="6">医疗</option>
                                            <option value="7">其他</option>
                                        </select> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">银行卡号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bankcard_no" lay-verify="bankcard_no" placeholder="填写银行卡号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所属银行</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bankcard_type" lay-verify="bankcard_type" placeholder="所属银行(如：中国工商银行静安支行)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">您希望申请的金额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="apply_amt" lay-verify="apply_amt" placeholder="请填写申请人申请的金额">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">您可接受每周最高还款金额</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="applier_week_amt" lay-verify="applier_week_amt" placeholder="请填写申请人可接受每周最高还款金额">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">借款期限</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="deadline" lay-verify="deadline" value="210" placeholder="请填写整数格式的借款期限">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">期限单位</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="deadline_type" value="1" title="天" checked>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="deadline_type" value="2" title="月">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <h5>工作人员</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">客户经理</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="survey_name" lay-verify="survey_name" placeholder="请填写客户经理">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="survey_phone" lay-verify="survey_phone" placeholder="请填写客户经理手机">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">发起人备注</label>
                                    <div class="col-sm-10">
                                        <input type="textarea" class="form-control" name="applier_remark" lay-verify="applier_remark" placeholder="请填写发起人备注">
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