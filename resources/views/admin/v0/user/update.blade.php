@extends("admin.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/admin/v0/js/user/update.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>修改申请</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/admin">首页</a>
                </li>
                <li>
                    <a href="/admin/user">用户列表</a>
                </li>
                <li class="active">
                    <strong>修改</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改用户</h5>
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
                        <form method="post" action="/admin/user/{{$applyInfo->user_id}}/update" class="form-horizontal layui-form">
                            <input type="hidden"  name="user_id" value="{{$applyInfo->user_id}}">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">账号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" lay-verify="username" lay-filter="username" name="username" value="{{$applyInfo->username}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">区域</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="district" lay-filter="district" lay-verify="district" value="{{$applyInfo->district}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">城市</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" lay-verify="city" lay-filter="city" name="city" value="{{$applyInfo->city}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">分部</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city_num" lay-filter="city_num" lay-verify="city_num" value="{{$applyInfo->city_num}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" lay-verify="mobile" lay-filter="mobile" name="mobile" value="{{$applyInfo->mobile}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户类型</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="role_id" class="role_id">
                                        <option value="1">超级管理员</option>
                                        <option value="2">初审</option>
                                        <option value="3">复审</option>
                                        <option value="4">终审</option>
                                        <option value="5">财务</option>
                                        <option value="6">经销</option>
                                    </select>
                                    <script> $(".role_id").find("option[value='{{$applyInfo->role_id}}']").attr("selected",true)</script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" class="status">
                                        <option value="1">正常</option>
                                        <option value="0">禁用</option>
                                    </select>
                                    <script> $(".status").find("option[value='{{$applyInfo->status}}']").attr("selected",true)</script>
                                </div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" lay-filter="submit" lay-submit type="button">修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection