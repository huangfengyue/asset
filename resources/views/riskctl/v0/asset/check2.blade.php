@extends("riskctl.v0.layouts.default")
@section("title","证书详情")
@section("head")
    <script src="{{asset('static/riskctl/v0/js/asset/check2.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>查看申请详情</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/riskctl">首页</a>
                </li>
                <li>
                    <a href="/riskctl/asset/check2">二审列表</a>
                </li>
                <li class="active">
                    <strong>请审核</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="/riskctl/asset/{{$applyInfo->apply_id}}" class="btn btn-info">基本信息</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>查看申请详情</h5>
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
                                <label class="col-sm-2 control-label">借款协议资料压缩包下载地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">
                                        <span class="img-uri" data-uri="{{getOssZipUri($applyInfo->zip_auth)}}">{{substr(getOssZipUri($applyInfo->zip_auth),0,50)}}...</span>
                                        <a target="_blank" download="{{getDlName($applyInfo->zip_auth)}}" href="{{getOssZipUri($applyInfo->zip_auth)}}">下载</a></p>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">资料补充时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck2_submit_time?date("Y-m-d H:i",$applyInfo->ck2_submit_time):"--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">资产二审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->asset_ck2_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">风控二审备注</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="riskctl_ck2_remark" placeholder="请填写您审核的意见或建议">{{$applyInfo->riskctl_ck2_remark}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/riskctl/asset/check2">返回</a>
                                    <button class="btn btn-primary" id="btn-agree"  type="button">同意</button>
                                    <a class="btn btn-white" href="javascript:;" id="btn-modify">退回修改</a>
                                    <a class="btn btn-white" href="javascript:;" id="btn-ignore">拒绝</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection