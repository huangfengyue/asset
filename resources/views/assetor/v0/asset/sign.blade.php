@extends("assetor.v0.layouts.default")
@section("title","查看申请详情")
@section("head")
    <script src="{{asset('static/assetor/v0/js/asset/check1.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>查看申请详情</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/assetor">首页</a>
                </li>
                <li>
                    <a href="/assetor/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>申请详情</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="/assetor/asset/{{$applyInfo->apply_id}}/cert" class="btn btn-info">证件信息</a>
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
                            <input type="hidden" name="apply_id" value="{{$applyInfo->apply_id}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">借款金额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="apply_amt" lay-verify="apply_amt" value="{{$applyInfo->apply_amt}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" id="btn-sign"  type="button">确认</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection