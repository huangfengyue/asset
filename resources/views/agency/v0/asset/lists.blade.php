@extends("agency.v0.layouts.default")
@section("title","资产管理")
@section("head")
    <script type="text/javascript" src="{{asset('static/agency/v0/js/asset/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>进件列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">首页</a>
                </li>
                <li class="active">
                    <strong>进件列表</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            <div class="title-action">
                {{--<a href="{{url('agency/asset/face_trial')}}" class="btn btn-info">发起申请</a>--}}
                <a href="{{url('agency/asset/face_trial')}}" class="btn btn-info">发起申请</a>
                <button class="layui-btn" onclick="SendForms();"/>导出excel表格</button>
            </div>
        </div>

    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title" id="ibox-title">
                        <h5>当前有<span></span>个件待审件</h5>
                        <div class="ibox-tools">
                            <div>
                                <strong><font style="font-size: 15px">借款人</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_name" id="applier_name" maxlength="20"/>
                                <strong><font style="font-size: 15px">联系方式</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="phone" id="phone" maxlength="20"/>
                                <strong><font style="font-size: 15px">身份证号</font></strong>:&nbsp;&nbsp;&nbsp;<input type="text" size="10" name="applier_idcard" id="applier_idcard" maxlength="20"/>
                                <strong><font style="font-size: 15px">状态</font></strong>:&nbsp;&nbsp;&nbsp;<select name="status" id="status">
                                    <option value="">选择状态</option>
                                    <option value="1">等待审核</option>
                                    <option value="2">初审拒绝</option>
                                    <option value="3">待释放合同</option>
                                    <option value="4">复审拒绝</option>
                                    <option value="5">等待终审</option>
                                    <option value="6">终审拒绝</option>
                                    <option value="7">退回修改</option>
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
                                    <th>借款人</th>
                                    <th>联系方式</th>
                                    <th>身份证号</th>
                                    <th>借款期限</th>
                                    <th>类型</th>
                                    <th>最初上传时间</th>
                                    <th>状态</th>
                                    <th>聚信立是否录入</th>
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