@extends("agency.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/loan_category.js')}}"></script>
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

                        <form method="post" action="/agency/asset/loan_category" class="form-horizontal layui-form">
                            <h5>请选择贷款类别</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">贷款类别</label>
                                    <div class="col-sm-10">
                                        <select name="loan_category">
                                            <option value="佰事贷">佰事贷</option>
                                            <option value="街边贷">街边贷</option>
                                        </select>
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