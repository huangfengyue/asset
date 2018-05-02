@extends("riskctl.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/riskctl/v0/js/asset/repay.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>还款列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/riskctl">首页</a>
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
                        <h5>还款列表</h5>
                        {{--<div class="ibox-tools">--}}
                            {{--<a href="{{url('financer/repay/repay_excel')}}" class="btn btn-info">导出excel表格</a>--}}
                            {{--<a class="collapse-link">--}}
                                {{--<i class="fa fa-chevron-up"></i>--}}
                            {{--</a>--}}
                            {{--<a class="close-link">--}}
                                {{--<i class="fa fa-times"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered table-hover dataTablesAjax" >
                                <thead>
                                <tr>
                                    <th>流水号</th>
                                    <th>借款人</th>
                                    <th>产品类型</th>
                                    <th>放款金额</th>
                                    <th>总借款期数</th>
                                    <th>当前期数</th>
                                    <th>当前应收</th>
                                    {{--<th>当前应收服务费</th>--}}
                                    <th>逾期天数</th>
                                    <th>逾期费用</th>
                                    <th>当期应收总额</th>
                                    <th>银行卡号</th>
                                    <th>本期应收时间</th>
                                    <th>状态</th>
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