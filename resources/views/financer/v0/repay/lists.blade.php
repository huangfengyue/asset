@extends("financer.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/financer/v0/js/repay/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>还款列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/financer">首页</a>
                </li>
                <li class="active">
                    <strong>资产申请列表</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            <div class="title-action">
                <a href="{{url('financer/repay/repay_update')}}" class="btn btn-info">更新还款列表</a>
                <a href="{{url('financer/repay/repay_excel')}}" class="btn btn-info">导出excel表格</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">

                            <div class="ibox-title">
                                <div class="ibox-tools">
                                        <div>
                                            <strong><font style="font-size: 15px">查询借款人关键字</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_name" id="applier_name" maxlength="20"/>
                                            <strong><font style="font-size: 15px">查询状态关键字</font></strong>:&nbsp;&nbsp;&nbsp;<select name="status" id="status">
                                                <option value="">选择状态</option>
                                                <option value="1">正常待还</option>
                                                <option value="2">正常已还</option>
                                                <option value="3">提前结清</option>
                                                <option value="4">逾期待还</option>
                                                <option value="5">逾期已还</option>
                                                <option value="6">尚未结清</option>
                                            </select>

                                    <button class="layui-btn" onclick="SendForm();"/>搜索</button>
                                        </div>
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
                                    <th>城市</th>
                                    <th>分部</th>
                                    <th>借款人</th>
                                    <th>产品类型</th>
                                    <th>放款金额</th>
                                    <th>总借款期数</th>
                                    <th>当前期数</th>
                                    <th>当前应收</th>
                                    <th>当前应收服务费</th>
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