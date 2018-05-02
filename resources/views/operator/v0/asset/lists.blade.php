@extends("operator.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/operator/v0/js/asset/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>申请列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">首页</a>
                </li>
                <li class="active">
                    <strong>资产申请列表</strong>
                </li>
            </ol>
        </div>

    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>申请列表</h5>
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
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered table-hover dataTablesAjax" >
                                <thead>
                                <tr>
                                    <th>流水号</th>
                                    <th>借款人</th>
                                    <th>手机号</th>
                                    <th>融资金额</th>
                                    <th>借款期限</th>
                                    <th>银行卡号</th>
                                    <th>省会城市</th>
                                    <th>类型</th>
                                    <th>最初上传时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                    <th>查看</th>
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