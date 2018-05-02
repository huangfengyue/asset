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
    <title>借款承诺书</title>
    <style>
        body{margin: 0px; padding: 0px; color: #000; font-size: 12px; line-height: 25px;}
        .content{padding: 20px 10%; width: 80%; font-size: 16px; letter-spacing:8px}
        h1{text-align: center; font-size: 28px; line-height: 50px;}
        .jc{font-size: 14px; font-weight: bold;}
        .te_right{text-align: right;fs}
        .pad_right{padding-right: 200px;}

    </style>
</head>
<body>
<div class="content">
    <h1 class="mar_btm">借款承诺书</h1>
    <br>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;本人 {{$applyInfo->applier_name}} &nbsp;&nbsp;&nbsp;身份证号：{{$applyInfo->applier_idcard}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 因个人短期消费需要资金，特通过上海高富金融信息服务有限公司向出借人提出借款需求。现本人申请借款合同金额为人民币（大写）
        {{$applyInfo->char}}
        （￥{{$applyInfo->apply_amt_all}}元），并承诺每周偿还本息数额（￥{{$applyInfo->apply_week_amt}}元）。该笔借款自借款日当天起计息。共计还满（ {{$applyInfo->apply_week_num}}周）。</p>

    <p class="jc">&nbsp;&nbsp;&nbsp;&nbsp;本人承诺所提供材料均为本人自愿，且真实，如有虚假或者逾期，本人愿意全额退还并缴纳罚息，自应还款日起每日按借款合同金额的 @if($applyInfo["loan_category"]=="佰事贷")0.1%@elseif($applyInfo["loan_category"]=="街边贷")0.3% @endif缴纳罚息。所产生的任何风险一律由本人自行承担。 </p>
    <p>特此承诺！ </p>
    <p class="te_right pad_right">承诺人签字：</p>
    <p class="te_right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</p>
</div>
</body>
</html>
