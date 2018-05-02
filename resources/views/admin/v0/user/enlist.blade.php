@extends("admin.v0.layouts.default")
{{--@section("title","公益使者申请列表")--}}
@section("head")
    <script src="{{asset('static/admin/v0/js/asset/enlist.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>公益使者申请列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/financer">首页</a>
                </li>
                <li class="active">
                    <strong>公益使者申请列表</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            {{--<div class="title-action">--}}
            {{--<button class="layui-btn" onclick="SendForms();"/>导出excel表格</button>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <div class="ibox-tools">
                            {{--<div>--}}
                            {{--<strong><font style="font-size: 15px">查询借款人关键字</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_name" id="applier_name" maxlength="20"/>--}}
                            {{--<strong><font style="font-size: 15px">起息时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="cktime1" id="cktime1" maxlength="20"/> —— <input type="text" size="10" name="cktime2" id="cktime2" maxlength="20"/>--}}
                            {{--<strong><font style="font-size: 15px">起息时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="cktime" id="cktime" maxlength="20"/>--}}

                            {{--<strong><font style="font-size: 15px">放款时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="time1" id="time1" maxlength="20"/> —— <input type="text" size="10" name="time2" id="time2" maxlength="20"/>--}}
                            {{--<strong><font style="font-size: 15px">放款时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="time" id="time" maxlength="20"/>--}}
                            {{--<button class="layui-btn" onclick="SendForm();"/>搜索</button>--}}
                            {{--</div>--}}
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered table-hover dataTablesAjax" >
                                <thead>
                                <tr>
                                    <th>联系人</th>
                                    <th>联系方式</th>
                                    <th>所在城市</th>
                                    <th>报名类型</th>
                                    <th>报名时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="pager-nav" class="pager"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection