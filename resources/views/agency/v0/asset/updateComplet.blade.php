@extends("agency.v0.layouts.default")
@section("title","修改补充资料")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/updateComplet.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>修改补充资料</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/agency">首页</a>
                </li>
                <li>
                    <a href="/agency/asset/check2">二审列表</a>
                </li>
                <li class="active">
                    <strong>修改补充资料</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>上传相关资料</h5>
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
                        <form name="cert-form" method="post" action="/agency/asset/{{$applyInfo->apply_id}}/update-complet" class="form-horizontal layui-form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">当前资料补充时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck2_submit_time?date("Y-m-d H:i",$applyInfo->ck2_submit_time):"--"}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> 新上传资料</label>
                                    <div class="col-sm-5">
                                        <input type="file"  name="zip" class="form-control form-file">
                                    </div>
                                </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" lay-filter="submit" lay-submit type="button">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection