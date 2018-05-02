@extends("agency.v0.layouts.default")
@section("title","上传证件资料")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/createStep2.js')}}"></script>
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
                <li>
                    <a href="/agency/asset/create">发起申请</a>
                </li>
                <li class="active">
                    <strong>上传资料</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>上传证件资料</h5>
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
                        <form name="cert-form" method="post" action="/agency/asset/create/step2" class="form-horizontal layui-form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @foreach($certTypeItem as $k => $v)
                                @if($k >0) <div class="hr-line-dashed"></div> @endif
                            @if($v->require == 1) <input type="hidden" class="require-type" value="{{$v->type_id}}" type-name="{{$v->type_name}}"> @endif
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> @if($v->require == 1) <span style="color: red;">*</span> @endif{{$v->type_name}}</label>
                                <div class="col-sm-5">
                                    <input type="file" data-size="5000000" name="type_id_{{$v->type_id}}[]" class="form-control form-file" type-id="{{$v->type_id}}" onchange="fileInputChange(this)">
                                    <img class="form-img-preview" style="display: none;" type-id="{{$v->type_id}}">
                                </div>
                                <div class="col-sm-5">
                                    <input type="button" class="layui-btn layui-btn-disabled btn-preview-look" type-id="{{$v->type_id}}" value="预览" onclick="filePreview(this)"/>
                                    <input type="button" class="layui-btn layui-btn-disabled btn-preview-add" type-id="{{$v->type_id}}" onclick="fileInputAdd(this)" value="新增"/>
                                </div>

                            </div>
                            @endforeach
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