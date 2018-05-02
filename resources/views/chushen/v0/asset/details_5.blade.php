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
    <title>信用咨询及管理服务协议（借款人）</title>
    <style>
        body{margin: 0px; padding: 0px; color: #000; font-size: 12px; line-height: 25px;}
        .content{padding: 20px 10%; width: 80%; font-size: 16px;}
        h1{text-align: center; font-size: 28px; line-height: 50px;}
        .fon_sz{font-size: 16px;}
        .mar_btm{margin-bottom: 50px;}
        .mar_btms{margin-top: 150px;}
        .mar_btmss{margin-top: 10px;}
        .line_h{line-height: 50px;}
        .padding_l{padding-left: 25px;}
        table tr td{text-align: center;}
        .xhx{text-decoration:underline; }
        .al_left{text-align: left; padding-left: 20px;}
        .jc{ font-weight: bold;}
    </style>
</head>
<body>
<div class="content">
    <h1 class="mar_btm">信用咨询及管理服务协议（借款人）</h1>
    <p class=" fon_sz">甲方（服务提供商）：上海高富金融信息服务有限公司</p>
    <p class="mar_btm fon_sz">地址：上海市中山北路1958号华源世界广场24楼 </p>

    <p class="fon_sz">乙方（资金借入方）:{{$applyInfo->applier_name}}</p>
    <p class="fon_sz">身份证号: {{$applyInfo->applier_idcard}}</p>
    <p class="fon_sz">现住址:{{$applyInfo->applier_address}}</p>
    <p class="fon_sz mar_btm">手机号码 :{{$applyInfo->applier_mobile}} </p>


    <p>鉴于：乙方有一定的资金需求；甲方通过其业务合作伙伴的业务资质、业务专业能力为乙方办理借款申请、信用咨询管理服务、还款管理等系列服务为乙方提供信用咨询、信用评审等系列信用管理服务，现各方就相应服务达成一致，特订立本协议。
    </p>

    <h2>第一条 、乙方权利与义务</h2>
    <p>1)乙方有权向甲方了解其信用评审进度及结果；</p>

    <p>2)乙方在申请及实现借款的全过程中，必须如实向甲方提供其所要求提供的个人信息；</p>


    <p>3)乙方在甲方建立个人信用账户，授权甲方基于乙方提供的信息及甲方独立获取的信息管理乙方的信用信息；</p>

    <p>4)乙方经甲方推荐，与特定的出借人于<span class="xhx">{{$applyInfo->ck1_sign_time_firsts[0]}}</span>年<span class="xhx">{{$applyInfo->ck1_sign_time_firsts[1]}}</span>月<span class="xhx">{{$applyInfo->ck1_sign_time_firsts[2]}}</span>日签署了《借款协议》借款合同金额为人民币<span class="xhx">{{$applyInfo->apply_amt_all}}</span>元整（小写）<span class="xhx">
            {{$applyInfo->char}}</span>（大写），合同编号：<span class="xhx">{{$applyInfo->borrow_nid}}</span>   ，下文所提到的《借款协议》 即指本特定的《借款协议》，需按照本协议规定向甲方支付服务费。</p>
    <h2>第二条、甲方权利与义务</h2>
    <p>1)甲方有权根据对乙方的评审结果，决定是否将乙方的借款需求向出借人进行推荐，以协助乙方取得资金来源；</p>
    <p>2)甲方须为乙方提供借款及还款相关的全程咨询及管理服务；</p>
    <p>3)甲方有权向乙方收取双方约定的服务费，有权以借款咨询服务为目的使用乙方个人信用信息。</p>
    <p>4)甲方有权获得乙方的个人信用信息，但该信息仅用于信用审核目的；</p>
    <p>5)甲方有权通过乙方提供的个人信用信息及行为记录来评定乙方所拥有的个人信用等级；</p>
    <p>6）甲方需为乙方提供相应信用审核、贷后管理、催收服务；</p>

    <h2>第三条、服务费 </h2>
    <p>在本协议中， @if($applyInfo["loan_category"]=="佰事贷")“服务费”是指 @elseif($applyInfo["loan_category"]=="街边贷")“服务费”包括出借人收益及 @endif因甲方为乙方提供业务咨询、评估、推荐出借人、还款 提醒、账户管理、还款特殊情况沟通等系列相关服务为乙方提供信用审核等服务而由乙方支付给甲方的报酬。对于甲方向乙方提供的系列服务，乙方同意在获得《借款协议》约定的借款资金的当日向甲方支付服务费人民币￥<span class="xhx">{{$applyInfo->apply_service_amt}}</span>元整（大写：<span class="xhx">
           {{$applyInfo->service}}
        </span>）。乙方同意服务费由出借人在交付借款本金的当日一次性从借款本金中扣除，并由出借人代为交付给甲方。 </p>
    @if($applyInfo["loan_category"]=="佰事贷")
    <p class="jc">若乙方提前还款或提前一次性结清应还款金额的，甲方则根据乙方实际还款情况扣除对应的提前还款服务费后足额退还折算后的服务费余额。</p>
    @elseif($applyInfo["loan_category"]=="街边贷")
        <p class="jc"> 若乙方提前还款的，需还满15期且按要求办理提前还款手续，并需一次性支付剩余贷款本金+当期应还本息；如未还满15期则另需支付借款合同金额3%的还款违约金进行贷款提前还款结清。 </p>
    @endif
        <p class="jc">提前还款说明：</p>
    <p>1、30期{{$applyInfo->loan_category}}产品：  @if($applyInfo["loan_category"]=="佰事贷")8  @elseif($applyInfo["loan_category"]=="街边贷")15 @endif期后可以提前还款，提前还款都需收取一期借款服务费作为提前还款服务费。</p>

    <h2>第四条、违约规定</h2>
    <p>任何一方违反本协议的约定，使得本协议的全部或部分不能履行，均应承担违约责任， 并赔偿对方因此遭受的损失（包括由此产生的诉讼费和律师费）；如双方违约，根据实际情况各自承担相应的责任。甲方保留将乙方违约失信的相关信息在媒体披露的权利。因乙方未还款而带来的调查费、差旅费、诉讼费、律师费等实现债权的费用将由乙方承担。</p>
    <h2>第五条、变更通知 </h2>
    <p>本协议签订之日起至借款全部清偿之日止，乙方有义务在下列信息变更三日内提供更 新后的信息给甲方和出借人，包含但不限于乙方本人、乙方的家庭联系人及紧急联系 人工作单位、居住地址、住所电话、手机号码、电子邮件的变更。若因乙方不及时提供上述变更信息而导致的甲方或甲方指定指点三方调查费、差旅费、诉讼费、律师费等实现债权的费用将由乙方承担。  </p>
    <h2>第六条、其他</h2>
    <p>1）甲乙双方签署本协议后，本协议成立并生效。乙方与特定的出借人的《借款协 议》失效的同时，本协议第一条第三款、第二条第一款有关对乙方信用信息管理、保 密等规定长期有效。</p>
    <p>2）本协议及其附件的任何修改、补充均须以书面形式作出。</p>
    <p>3）本协议的传真件、复印件、扫描件等有效副本的效力与本协议原件效力一致。</p>
    <p>4）甲乙双方均确认，本协议的签署、生效和履行以不违反中国的法律法规为前提。如果本协议中任何一条或多条违反中国的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</p>
    <p>5）如果甲乙双方在本协议履行过程中发生任何争议，应友好协商解决；如协商不 成，则须提交该协议签署地上海市普陀区人民法院进行诉讼。</p>
    <p>6）本协议一式两份，甲乙各执一份，具有同等法律效力。</p>
    <p class="jc mar_btm"> &nbsp;&nbsp;&nbsp;&nbsp;本人已阅读并完全知悉上述条款和了解贵公司服务，此项签署为本人完全意愿的表  述。（请乙方确定已阅读完本项协议，并在此处确认签章）</p>

    <p class="jc ">协议各方签字盖章：</p>

    <div style="position:relative;">甲方（盖章）：上海高富金融信息服务有限公司</div>
    <div style="position:absolute;"><img src="{{asset('/static/common/v0/images/2.png')}}" height="200px"; width="200px"></div>
    <p class="mar_btm">日期： </p>
    <p class="mar_btms">乙方（签字）：</p>
    <p class="mar_btmss" >日期： </p>

</div>
</body>
</html>
