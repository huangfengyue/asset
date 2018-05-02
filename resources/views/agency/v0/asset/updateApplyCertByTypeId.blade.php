@extends("agency.v0.layouts.nosidebar")
@section("title","上传证件资料")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/updateApplyCertByTypeId.js')}}"></script>
@endsection
@section("content")
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
                        <form name="cert-form" method="post" action="/agency/asset/{{$applyInfo->apply_id}}/update/{{$typeInfo->type_id}}" class="form-horizontal layui-form" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <input type="hidden" name="apply_id" value="{{$applyInfo->apply_id}}">
                                    <input type="hidden" name="type_id" value="{{$typeInfo->type_id}}">
                                    <input type="hidden" name="require" value="{{$typeInfo->require}}">
                                    <label class="col-sm-2 control-label">{{$typeInfo->type_name}}</label>
                                    <div class="col-sm-5">
                                        <input type="file" data-size="5000000" name="certFile[]" class="form-control form-file" onchange="fileInputChange(this)">
                                        <img class="form-img-preview" style="display: none;">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="button" class="layui-btn layui-btn-disabled btn-preview-look" value="预览" onclick="filePreview(this)"/>
                                        <input type="button" class="layui-btn layui-btn-disabled btn-preview-add" onclick="fileInputAdd(this)" value="新增"/>
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