@extends("financer.v0.layouts.default")
@section("title","查看申请详情")
@section("head")
    <script src="{{asset('static/financer/v0/js/asset/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>还款信息操作</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/financer">首页</a>
                </li>
                <li>
                    <a href="/financer/asset">资产申请列表</a>
                </li>
                <li class="active">
                    <strong>还款信息操作</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="/financer/asset/{{$applyInfo->apply_id}}/cert" class="btn btn-info">证件信息</a>
                <a href="/financer/asset/{{$applyInfo->apply_id}}/ck2-info" class="btn btn-info">二审信息</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>还款信息操作</h5>
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
                            <div class="form-group">
                                <label class="col-sm-2 control-label">借款人姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">产品类型</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->loan_category}}</p>
                                </div>
                                <label class="col-sm-2 control-label">实际放款金额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_real_amt}}</p>
                                </div>

                                <label class="col-sm-2 control-label">总借款期数</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_num}}</p>
                                </div>
                                <label class="col-sm-2 control-label">当前期数</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_now}}</p>
                                </div>
                                <label class="col-sm-2 control-label">当前应收</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">当前应收服务费</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_service_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">逾期天数</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->repay_late_days}}</p>
                                </div>
                                <label class="col-sm-2 control-label">逾期费用</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->repay_late_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">当前应收总额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->now_amt_all}}</p>
                                </div>
                                <label class="col-sm-2 control-label">银行卡号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->bankcard_no}}</p>
                                </div>
                                <label class="col-sm-2 control-label">本期应收时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->time}}</p>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label">真实还款金额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="real_amt_all" lay-verify="real_amt_all" placeholder="请填写借款人真实还款金额">

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">还款状态</label>
                                    <div class="col-sm-10">
                                        <select name="status">
                                            <option value="2">正常已还</option>
                                            <option value="3">提前结清</option>
                                            <option value="5">逾期已还</option>
                                            <option value="6">尚未结清</option>
                                        </select> </div>
                                </div>
                                <div class="form-group">

                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" id="btn-repay"  type="button">确定</button>
                                    <input type="hidden" name="repay_id" value="{{$applyInfo->id}}">
                                    <input type="hidden" name="apply_week_now" value="{{$applyInfo->apply_week_now}}">
                                    <input type="hidden" name="apply_week_num" value="{{$applyInfo->apply_week_num}}">
                                    <input type="hidden" name="apply_week_amt" value="{{$applyInfo->apply_week_amt}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection