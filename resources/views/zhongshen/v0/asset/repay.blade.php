@extends("zhongshen.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/zhongshen/v0/js/asset/repay.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>审件模块</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/zhongshen">首页</a>
                </li>
                <li class="active">
                    <strong>还款列表</strong>
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
                            <div>
                                <strong><font style="font-size: 15px">借款人</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_name" id="applier_name" maxlength="20"/>
                                <strong><font style="font-size: 15px">联系方式</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="phone" id="phone" maxlength="20"/>
                                <strong><font style="font-size: 15px">身份证号</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_idcard" id="applier_idcard" maxlength="20"/>
                                <strong><font style="font-size: 15px">放款金额</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="apply_amt_final" id="apply_amt_final" maxlength="20"/>
                                <button class="layui-btn" onclick="SendForm();"/>搜索</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered table-hover dataTablesAjax" >
                                <thead>
                                <tr>
                                    <th>流水号</th>
                                    <th>区域</th>
                                    <th>城市</th>
                                    <th>分部</th>
                                    <th>借款人</th>
                                    <th>联系方式</th>
                                    <th>身份证号</th>
                                    <th>借款期限</th>
                                    <th>类型</th>
                                    <th>放款金额</th>
                                    <th>放款时间</th>
                                    <th>合同</th>
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