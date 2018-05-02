@extends("financer.v0.layouts.default")
@section("title","查看申请详情")
@section("head")
    <script src="{{asset('static/financer/v0/js/asset/lists.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>查看申请详情</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/financer">首页</a>
                </li>
                <li>
                    <a href="/financer/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>申请详情</strong>
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
                        <h5>基本信息</h5>
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
                            <h5>借款人基本信息</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">借款合同编号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->borrow_nid}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款人姓名</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_name}}</p>
                                </div>
                                <label class="col-sm-2 control-label">联系方式</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_mobile}}</p>
                                </div>
                                <label class="col-sm-2 control-label">身份证号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_idcard}}</p>
                                </div>

                                <label class="col-sm-2 control-label">银行信息</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->bankcard_type}}</p>
                                </div>
                                <label class="col-sm-2 control-label">银行卡号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->bankcard_no}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款金额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">借款期数</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->deadline}}
                                        @if($applyInfo["deadline_type"]==1)天@elseif($applyInfo["deadline_type"]==2)月@endif
                                    </p>
                                </div>
                                <label class="col-sm-2 control-label">还款方式</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">等本等息</p>
                                </div>
                                <label class="col-sm-2 control-label">起息时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck1_sign_time_first}}</p>
                                </div>
                                <label class="col-sm-2 control-label">平台管理服务费率（每周）</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">1.76%</p>
                                </div>
                                <label class="col-sm-2 control-label">平台管理费</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_service_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">利息年化利率（每天）</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">0.30%</p>
                                </div>
                                <label class="col-sm-2 control-label">利息合计</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_intrests*30}}</p>
                                </div>
                                <label class="col-sm-2 control-label">周还款本金</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_ben}}</p>
                                </div>
                                <label class="col-sm-2 control-label">周还款利息</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_intrests}}</p>
                                </div>
                                <label class="col-sm-2 control-label">周还款总额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_week_amt}}</p>
                                </div>
                                <label class="col-sm-2 control-label">放款金额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_amt_final}}</p>
                                </div>
                                <label class="col-sm-2 control-label">实际放款金额</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->apply_real_amt}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->status_name}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">最初提交时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{date("Y-m-d H:i",$applyInfo->create_time)}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">一审通过时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck1_pass_time?date("Y-m-d H:i",$applyInfo->ck1_pass_time):"--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">二审提交时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck2_submit_time?date("Y-m-d H:i",$applyInfo->ck2_submit_time):"--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">二审通过时间</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->ck2_pass_time?date("Y-m-d H:i",$applyInfo->ck2_pass_time):"--"}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发起人备注信息</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->applier_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">资产一审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->asset_ck1_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">风控一审备注</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$applyInfo->riskctl_ck1_remark or "--"}}</p>
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
                                    <p class="form-control-static">{{$applyInfo->riskctl_ck2_remark or "--"}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <input type="hidden" name="apply_id" value="{{$applyInfo->apply_id}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">财务意见</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="remark" lay-verify="remark" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" id="btn-loan"  type="button">同意</button>
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