@extends("agency.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/agency/v0/js/asset/Face_trial.js')}}"></script>
@endsection
@section("content")
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>发起新申请</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/agency">首页</a>
                </li>
                <li>
                    <a href="/agency/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>面审目录</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>审查项</h5>
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

                        <form method="post" action="/agency/asset/face_trial" class="form-horizontal layui-form">
                            <h5>基本信息核实</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">申请贷款人姓名</label>
                                    <div class="col-sm-10">
                                        <label><input name="applier_name"  value=""  /></label>
                                         </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">年龄符合，读取身份证正常</label>
                                    <div class="col-sm-10">
                                        <label><input name="type1"  type="radio" value="1" title="是" /></label>
                                        <label><input name="type1" type="radio" value="0" title="否" /></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">身份证，常住地是否本地</label>
                                    <div class="col-sm-10">
                                        <label><input name="type2" type="radio" value="1" title="是" /></label>
                                        <label><input name="type2" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否禁止人群(敏感职业)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type3" type="radio" value="1" title="是"/></label>
                                        <label><input name="type3" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">申请借款手机号是否常用手机号</label>
                                    <div class="col-sm-10">
                                        <label><input name="type4" type="radio" value="1" title="是"/></label>
                                        <label><input name="type4" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">运营商实名制并使用满90天；期间没有超过3天以上无通讯，或累计超过20天无通讯</label>
                                    <div class="col-sm-10">
                                        <label><input name="type5" type="radio" value="1" title="是"/></label>
                                        <label><input name="type5" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">实际住址是否TB,JD常用收件地址</label>
                                    <div class="col-sm-10">
                                        <label><input name="type6" type="radio" value="1" title="是"/></label>
                                        <label><input name="type6" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否失业(无收入)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type7" type="radio" value="1" title="是"/></label>
                                        <label><input name="type7" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否失信人，被执行人(失信网http://zhixing.court.gov.cn/search/)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type8" type="radio" value="1" title="是"/></label>
                                        <label><input name="type8" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">滴滴，携程，去哪儿，饿了么等服务app自动登录联系手机号为本次申请手机号</label>
                                    <div class="col-sm-10">
                                        <label><input name="type9" type="radio" value="1" title="是"/></label>
                                        <label><input name="type9" type="radio" value="0" title="否"/></label>
                                        <label><input name="type9" type="radio" value="2" title="无app"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">婚姻状况</label>
                                    <div class="col-sm-10">
                                        <label><input name="type10" type="radio" value="3" title="已婚"/></label>
                                        <label><input name="type10" type="radio" value="4" title="未婚"/></label>
                                        <label><input name="type10" type="radio" value="5" title="单身"/></label>   </div>
                                </div>

                            </div>

                            <h5>通讯核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否多个微信，支付宝账号</label>
                                    <div class="col-sm-10">
                                        <label><input name="type11" type="radio" value="1" title="是"/></label>
                                        <label><input name="type11" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信账号非本机手机号</label>
                                    <div class="col-sm-10">
                                        <label><input name="type12" type="radio" value="1" title="是"/></label>
                                        <label><input name="type12" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信，短信是否有催收记录</label>
                                    <div class="col-sm-10">
                                        <label><input name="type13" type="radio" value="1" title="是"/></label>
                                        <label><input name="type13" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">通话记录前10是否同业，黑名单</label>
                                    <div class="col-sm-10">
                                        <label><input name="type14" type="radio" value="1" title="是"/></label>
                                        <label><input name="type14" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机中网贷app数超过3个</label>
                                    <div class="col-sm-10">
                                        <label><input name="type15" type="radio" value="1" title="是"/></label>
                                        <label><input name="type15" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>负债查询</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否拥有信用卡</label>
                                    <div class="col-sm-10">
                                        <label><input name="type16" type="radio" value="1" title="是"/></label>
                                        <label><input name="type16" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否有房，车贷</label>
                                    <div class="col-sm-10">
                                        <label><input name="type17" type="radio" value="1" title="是"/></label>
                                        <label><input name="type17" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否在小贷，网贷，花呗，借呗，京东白条，京东金条正在还款中</label>
                                    <div class="col-sm-10">
                                        <label><input name="type18" type="radio" value="1" title="是"/></label>
                                        <label><input name="type18" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">以上负债是否逾期超过90天</label>
                                    <div class="col-sm-10">
                                        <label><input name="type19" type="radio" value="1" title="是"/></label>
                                        <label><input name="type19" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>联系人核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">直系联系人3天内有通信</label>
                                    <div class="col-sm-10">
                                        <label><input name="type20" type="radio" value="1" title="是"/></label>
                                        <label><input name="type20" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">常用联系人3天内有通信</label>
                                    <div class="col-sm-10">
                                        <label><input name="type21" type="radio" value="1" title="是"/></label>
                                        <label><input name="type21" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所有联系人确为本人且可接听</label>
                                    <div class="col-sm-10">
                                        <label><input name="type22" type="radio" value="1" title="是"/></label>
                                        <label><input name="type22" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所有联系人非同业</label>
                                    <div class="col-sm-10">
                                        <label><input name="type23" type="radio" value="1" title="是"/></label>
                                        <label><input name="type23" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所有联系人非禁止人群，限制人群，被执行人，失信人</label>
                                    <div class="col-sm-10">
                                        <label><input name="type24" type="radio" value="1" title="是"/></label>
                                        <label><input name="type24" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">所有联系人可配合回访(信用卡，保险，快递等名义)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type25" type="radio" value="1" title="是"/></label>
                                        <label><input name="type25" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>职业核实</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位信息可查，114，百度固话，地址可查</label>
                                    <div class="col-sm-10">
                                        <label><input name="type26" type="radio" value="1" title="是"/></label>
                                        <label><input name="type26" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">单位有固话且有人接听</label>
                                    <div class="col-sm-10">
                                        <label><input name="type27" type="radio" value="1" title="是"/></label>
                                        <label><input name="type27" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">TB，JD常用收件地址同单位地址</label>
                                    <div class="col-sm-10">
                                        <label><input name="type28" type="radio" value="1" title="是"/></label>
                                        <label><input name="type28" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">同事常用联系人有正常通信</label>
                                    <div class="col-sm-10">
                                        <label><input name="type29" type="radio" value="1" title="是"/></label>
                                        <label><input name="type29" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>外网核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">综合分(灰度分)是否低于3分</label>
                                    <div class="col-sm-10">
                                        <label><input name="type30" type="radio" value="1" title="是"/></label>
                                        <label><input name="type30" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否贷款黑名单</label>
                                    <div class="col-sm-10">
                                        <label><input name="type31" type="radio" value="1" title="是"/></label>
                                        <label><input name="type31" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否身份存疑(身份证组合其他信息)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type32" type="radio" value="1" title="是"/></label>
                                        <label><input name="type32" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否联系人黑名单超过50%</label>
                                    <div class="col-sm-10">
                                        <label><input name="type33" type="radio" value="1" title="是"/></label>
                                        <label><input name="type33" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否多个手机号</label>
                                    <div class="col-sm-10">
                                        <label><input name="type34" type="radio" value="1" title="是"/></label>
                                        <label><input name="type34" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>资产核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否有房(自建房，安置房等各类自有房产)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type35" type="radio" value="1" title="是"/></label>
                                        <label><input name="type35" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否有机动车</label>
                                    <div class="col-sm-10">
                                        <label><input name="type36" type="radio" value="1" title="是"/></label>
                                        <label><input name="type36" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否有车位(家庭)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type37" type="radio" value="1" title="是"/></label>
                                        <label><input name="type37" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>家庭状况核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否分居</label>
                                    <div class="col-sm-10">
                                        <label><input name="type38" type="radio" value="1" title="是"/></label>
                                        <label><input name="type38" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">双方关系良好</label>
                                    <div class="col-sm-10">
                                        <label><input name="type39" type="radio" value="1" title="是"/></label>
                                        <label><input name="type39" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">无家庭经济纠纷(催收上门或父母被催收)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type40" type="radio" value="1" title="是"/></label>
                                        <label><input name="type40" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <h5>加额项核查</h5>
                            <div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">支付宝芝麻信用分超过670分</label>
                                    <div class="col-sm-10">
                                        <label><input name="type41" type="radio" value="1" title="是"/></label>
                                        <label><input name="type41" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">申请人有两万以上信用卡，且半年内还款正常</label>
                                    <div class="col-sm-10">
                                        <label><input name="type42" type="radio" value="1" title="是"/></label>
                                        <label><input name="type42" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">有社保，公积金(需网页截图上传系统)</label>
                                    <div class="col-sm-10">
                                        <label><input name="type43" type="radio" value="1" title="是"/></label>
                                        <label><input name="type43" type="radio" value="0" title="否"/></label>   </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="javascript:;" onclick="window.history.back()">返回</a>
                                    <button class="btn btn-primary" lay-filter="next" lay-submit type="button" id="btnSubmit">下一步</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection