@extends("fushen.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/fushen/v0/js/repay/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>审件系统</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/fushen">首页</a>
                </li>
                <li class="active">
                    <strong>还款跟踪</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            <div class="title-action">
                <button class="layui-btn" onclick="SendForms();"/>导出excel表格</button>
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
                                        <strong><font style="font-size: 15px">本期应收时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="time1" id="time1" maxlength="20"/> —— <input type="text" size="10" name="time2" id="time2" maxlength="20"/>
                                        <strong><font style="font-size: 15px">本期应收时间</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="times" id="times" maxlength="20"/>

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