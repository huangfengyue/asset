<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable = no">
    <meta http-equiv="Lang" content="en">
    <meta name="author" content="">
    <meta http-equiv="Reply-to" content="@.com">
    <meta name="generator" content="PhpED 8.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="creation-date" content="09/06/2012">
    <meta name="revisit-after" content="15 days">
    <title>协议附件:还款明细说明</title>
    <style>
        body{margin: 0px; padding: 0px; color: #000; font-size: 12px; line-height: 25px;}
        .content{padding: 20px 10%; width: 80%; font-size: 12px; }
        h1{text-align: center; font-size: 28px; line-height: 50px;}
        .jc{font-size: 14px; font-weight: bold;}
        .te_right{text-align: right;}
        .pad_right{padding-right: 200px;}
        label{width: 60px; display: block; float: left; }
        .pad_left{padding-left: 60px;}
        div{padding-left: 30px;}
        table.tex tr td{text-align: center;}
        table.tet tr td {width: 22%;}
        table.tet tr td.w{width: 34%;}
        .xhx{text-decoration:underline; }

    </style>
</head>
<body>
<div class="content">
    <h1 class="mar_btm">协议附件:还款明细说明</h1>
    <p style="border-bottom: 2px solid #000;">合同编号：{{$applyInfo->borrow_nid}}</p>
    <table class="tet" border="0" cellpadding="0"  cellspacing="0" width="100%">
        <tr>
            <td class="w">起息日期{{$applyInfo->ck1_sign_time_first}}</td>
            <td>起始日期{{$applyInfo->ck1_sign_time_first}}</td>
            <td>结束日期{{$applyInfo->ck1_sign_time_last}}</td>
        </tr>
        <tr>
            <td class="w">借款合同金额：¥
                @if($applyInfo["loan_category"]=="佰事贷"){{$applyInfo->apply_amt_all}}@elseif($applyInfo["loan_category"]=="商户贷"){{$applyInfo->apply_amt_final}}@endif</td>
            <td>借款期数： {{$applyInfo->apply_week_num}} </td>
            <td >周还款额：¥  {{$applyInfo->apply_week_amt}}</td>
        </tr>
        <tr>
            <td colspan="4" >产品类别：{{$applyInfo->loan_category}}</td>
        </tr>
        <tr>
            <td colspan="4" >平台管理服务费总额：¥  {{$applyInfo->apply_service_amt}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; （一次性收取）</td>
        </tr>
        <tr>
            <td class="w">开户名：{{$applyInfo->applier_name}}</td>
            <td>账号：{{$applyInfo->bankcard_no}} </td>
            <td>开户行：{{$applyInfo->bankcard_type}}</td>
        </tr>
    </table>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;借款成功当日扣除第一期应还金额，为了延续您良好的信用记录，请在每周还款日前一天检查确认当周应还款项已经存入专用账户，谢谢配合。提前全额还款：如果您决定提前结清借款，请通知当地分公司按要求办理提前还款手续，提前结清应退服务费在一次性全额还款金额中抵扣。</p>
    <table class="tex" border="1" cellpadding="0"  cellspacing="0" width="100%">
        <tr>
            <td>期数</td>
            <td >日期</td>
            <td>期初本金余额</td>
            <td>周还本金</td>
            <td>周还利息</td>
            <td>周还款额</td>
            <td>期末本金余额</td>
            @if($applyInfo["loan_category"]=="佰事贷")  <td>提前结清本期应退服务费</td>@endif
        </tr>
        @foreach ($ck1_sign_times as $k => $v)
        <tr>
            <td>{{$k+1}}</td>
            <td >{{$v["time"]}} </td>
            <td>{{$v["apply_amt_all_first"]}}</td>
            <td>{{$v["apply_week_ben"]}} </td>
            <td> {{$v["apply_week_intreset"]}}</td>
            <td>{{$v["apply_week_amt"]}} </td>
            <td> {{$v["apply_amt_all_last"]}}</td>
            @if($applyInfo["loan_category"]=="佰事贷") <td>{{$v["apply_service_amt"]}} </td>@endif

        </tr>
        @endforeach

    </table>
    <p class="jc">申请借款人签字：<span class="xhx">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 日期：<span class="xhx">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
</div>
</body>
</html>
