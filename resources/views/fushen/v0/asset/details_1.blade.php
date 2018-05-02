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
    <title>第三方借款协议</title>
    <style>
        body{margin: 0px; padding: 0px; color: #000; font-size: 12px; line-height: 25px;}
        .content{padding: 20px 10%; width: 80%;}
        h1{text-align: center; font-size: 28px; line-height: 50px;}
        .fon_sz{font-size: 14px;}
        .mar_btm{margin-bottom: 50px;}
        .he_tong{margin-top: -20px;float:right;font-size: 13px;}
        .line_h{line-height: 50px;}
        .padding_l{padding-left: 25px;}
        table tr td{text-align: center;}
        .xhx{text-decoration:underline; }
        .al_left{text-align: left; padding-left: 20px;}
    </style>
</head>
<body>
<div class="content">
    <h1 class="mar_btm">第三方借款协议</h1>
    <p class="he_tong">合同编号:{{$applyInfo->borrow_nid}}</p>
    <p class="mar_btm fon_sz">甲方（资金出借方）:金祖润</p>
    <p class="mar_btm fon_sz">身份证号:310109195005082016</p>
    <p class="fon_sz">乙方（资金借入方）:{{$applyInfo->applier_name}}</p>
    <p class="fon_sz">身份证号:{{$applyInfo->applier_idcard}}</p>
    <p class="fon_sz">现住址: {{$applyInfo->applier_address}}</p>
    <p class="fon_sz mar_btm">乙方手机号码:{{$applyInfo->applier_mobile}}</p>
    <p class="fon_sz">丙方（服务提供商）：上海高富金融信息服务有限公司 </p>
    <p class="fon_sz mar_btm">地址：上海市中山北路1958号华源世界广场24楼</p>
    <p>鉴于：1.丙方是一家在上海市合法成立并有效存在的公司，公司名称为：上海高富 金融信息服务有限公司，提供投资和信用咨询，为交易提供信息服务、企业 管理服务、广告信息发布、商务信息咨询服务。
    </p>
    <p class="mar_btm">2.甲乙双方确认本协议是通过丙方签署。 基于上述事实，甲乙丙三方就借款事宜达成协议如下。</p>
    <h2>一、借款及偿还方式</h2>
    <p>1.1 甲方承诺其出借资金为合法所得，甲方对该资金享有完整且无瑕疵的支配权。</p>
    {{--<p class="padding_l">甲方第三方支付机构收支账户信息：</p>--}}
    {{--<p class="padding_l">户名：蒋XX[会给到固定的户名，每份协议一致]</p>--}}
    {{--<p class="padding_l">账号：6227 XXXX XXXX XXXX XXX[会给到固定的账号，每份协议一致]</p>--}}
    <p>1.2 乙方承诺借款不用于炒股、买卖期货等及法律禁止的不合法用途。</p>
    <p>1.3 乙方向甲方借款，借款信息如下</p>
    <table border="1" cellpadding="0"  cellspacing="0" width="100%">
        <tr>
            <td class="al_left">借款详细用途</td>
            <td class="al_left">个人资金周转</td>
            <td>十万</td>
            <td>万</td>
            <td>千</td>
            <td>百</td>
            <td>十</td>
            <td>元</td>
            <td>角</td>
            <td>分</td>
        </tr>
        <tr>
            <td rowspan="2" class="al_left">借款合同金额</td>
            <td class="al_left">￥：  @if($applyInfo["loan_category"]=="佰事贷"){{$applyInfo->apply_amt_all}}@elseif($applyInfo["loan_category"]=="商户贷"||$applyInfo["loan_category"]=="街边贷"){{$applyInfo->apply_amt_final}}@endif</td>
            <td>{{$applyInfo->apply_amt_all_1}}</td>
            <td>{{$applyInfo->apply_amt_all_2}}</td>
            <td>{{$applyInfo->apply_amt_all_3}}</td>
            <td>{{$applyInfo->apply_amt_all_4}}</td>
            <td>{{$applyInfo->apply_amt_all_5}}</td>
            <td>{{$applyInfo->apply_amt_all_6}}</td>
            <td>{{$applyInfo->apply_amt_all_7}}</td>
            <td>{{$applyInfo->apply_amt_all_8}}</td>
        </tr>
        <tr>
            <td colspan="9" class="al_left">大写（人民币）：
                {{$applyInfo->char}}
            </td>
        </tr>
        <tr>
            <td class="al_left">周偿还本息数额</td>
            <td class="al_left">￥：{{$applyInfo->apply_week_amt}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{$applyInfo->apply_week_amt_1}}</td>
            <td>{{$applyInfo->apply_week_amt_2}}</td>
            <td>{{$applyInfo->apply_week_amt_3}}</td>
            <td>{{$applyInfo->apply_week_amt_4}}</td>
            <td>{{$applyInfo->apply_week_amt_5}}</td>
            <td>{{$applyInfo->apply_week_amt_6}}</td>
        </tr>
        <tr>
            <td class="al_left">还款分期数/周</td>
            <td class="al_left"> <span class="xhx ">&nbsp;{{$applyInfo->apply_week_num}}&nbsp;</span>周</td>
            <td colspan="8">（按时还款，节假日不顺延）</td>

        </tr>
        <tr>
            <td class="al_left">周还款起止日</td>
            <td colspan="9" class="al_left">{{$applyInfo->ck1_sign_time_first}}起至{{$applyInfo->ck1_sign_time_last}}止</td>

        </tr>

    </table>
    @if($applyInfo["loan_category"]=="佰事贷")
    <p>1.4 相关费用 </p>
    <p>1.4.1 乙方确认：<strong>就本次借款乙方应支付 3.0 元每千元每天的借款费用，该借款费用 包括乙方支付给丙丁双方的借款服务费</strong>，其具体由手机验证费、银行卡验证费、身 份验证费、征信审核费、信息发布费、撮合服务费、平台运营费、电话客户服务费、 客户端使用费等组成。丁方同意由丙方统一代收其本次应收服务费（即本次借款合同金额的1%）。乙方同意上述服务费从借款本金中先行扣除。</p>
    <p>1.4.2 乙方确认：就本次借款乙方应向丙方支付200元（大写：贰佰元整）的账户 管理费，用于相关账户的管理。乙方同意账户管理费从借款本金中先行扣除。 </p>
    <p>1.5 乙方还款金额及还款方式详见协议附件(还款明细说明)。 </p>
    <p>1.6 乙方须确保收支账户为乙方名下合法有效的银行账户，乙方变更账户时必须向 丙方申请签署《借款人客户信息变更书》并经甲方、丙方认可后方可变更。如因乙方未及时书面通知甲方、丙方引发的支付延迟，乙方应按照协议内容，支付逾期手 续费。</p>
    <p>1.7  乙方还款金额及时间详见《还款明细说明》。 </p>
    @elseif($applyInfo["loan_category"]=="商户贷")
    <p>1.4 乙方还款金额及还款方式详见协议附件(还款明细说明)。 </p>
    <p>1.5 乙方须确保收支账户为乙方名下合法有效的银行账户，乙方变更账户时必须向丙方申请签署《借款人客户信息变更书》并经甲方、丙方认可后方可变更。如因乙方未及时书面通知甲方、丙方引发的支付延迟，乙方应按照协议内容，支付逾期手续费。 </p>
    <p>1.6  乙方还款金额及时间详见《还款明细说明》。 </p>
    @endif
    <h2>二、借款的获取来源</h2>
    <p>2.1 乙方所获借款可能会来自于多位出借人，丙方或第三方支付机构会按照出借人 列表所明示的出借比例对该笔还款为相应的出借人进行还款分配。 </p>
    <h2>三、结算和支付方式</h2>
    {{--<p>乙方应在签署本协议的同时授权丙方指定的有支付结算资质的第三方支付机构，出 具委托手续并签订《委托扣款授权书》。 </p>--}}
    <p>3.1 甲方直接划转支付出借款项给乙方。 </p>
    <p>3.2 甲方授权丙方负责本协议下的借款回收及日常管理工作。甲乙方双方均同意丙方有权代甲方在必要时对乙方进行借款的违约提醒及催收工作，包括但不限于电话通知、发律师函、对乙方提起诉讼等。乙方对前述委托的提醒、催收事项已明确知晓并积极配合。</p>
    <h2>四、提前还款</h2>
    @if($applyInfo["loan_category"]=="佰事贷")
        <p>4.1 可提前还款，乙方提前还款的，须一次性将应还借款余额及对应的提前还款服务费结清。 </p>
    @elseif($applyInfo["loan_category"]=="商户贷")
        <p>4.1 可提前还款，乙方提前还款的，需一次性支付剩余贷款本金+当期应还本息及借款合同金额3%的还款违约金进行贷款提前还款结清。 </p>
    @elseif($applyInfo["loan_category"]=="街边贷")
        <p>4.1 可提前还款，乙方提前还款的，需还满15期且按要求办理提前还款手续，并需一次性支付剩余贷款本金+当期应还本息；如未还满15期则另需支付借款合同金额3%的还款违约金进行贷款提前还款结清。 </p>
    @endif
    <h2>五、违约责任</h2>
    <p>5.1 若乙方在还款期限之前未按照合同约定的收支账户存入还款金额或存入金额不 足的，即构成违约，并向甲方、丙方承担以下违约责任： </p>
    <p>5.1.1 甲方自应还款日起每日按借款合同金额的  @if($applyInfo["loan_category"]=="佰事贷")0.1%@elseif($applyInfo["loan_category"]=="商户贷"||$applyInfo["loan_category"]=="街边贷")0.3% @endif收取罚息。 </p>
    <p>5.1.2 逾期超过 30 日，丙方有权对乙方提供的及自行收集的乙方个人信息和资料编辑入网站黑名单，并将该黑名单对第三方披露，并与任何第三方数据共享，以便丙方或其委托的第三方催收逾期借款及对乙方的其他申请进行审核之用，由此因第三方的行为可能造成乙方的损失，丙方不承担法律责任。 </p>
    @if($applyInfo["loan_category"]=="商户贷")
        <p>5.1.3  乙方如提前还款，需支付甲方提前还款违约金（按借款合同金额的3%计算）。 </p>
    @elseif($applyInfo["loan_category"]=="街边贷")
        <p>5.1.3  乙方如提前还款未还满15期，另需支付甲方提前还款违约金（按借款合同金额的3%计算）。 </p>
    @endif
    <p>5.2 守约方为追回损失而支付的包括但不限于律师费、诉讼费、公证费、交通通讯 费等费用，由违约方承担。 </p>
    <h2>六、税务</h2>
    <p>协议各方在资金出借、转让过程产生的税费，自行向主管税务机关申报、缴纳。 </p>
    <h2>七、通知及送达</h2>
    <p>7.1 在本协议有效期内，因法律、法规、政策的变化，或任一方丧失履行本协议的 资格和/或能力，影响本协议履行的，该方应承担在合理时间内通知其他各方的义务。</p>
    <p>7.2 协议各方同意，与本协议有关的任何通知，以书面方式送达方为有效。书面形式包括但不限于：传真、快递、邮件、电子邮件。上述通知应当被视为在下列时间 送达：以传真发送，为该传真成功发送并由收件方收到之日；以快递或专人发送，为收件人收到该通知之日；以挂号邮件发送，为发出后 7 个工作日；以电子邮件发送，以电子邮件成功发出之日。 </p>
    <h2>八、协议的变更、解除和终止</h2>
    <p>除本协议或法律另有规定外，协议的变更、解除和终止以下列约定为准。 </p>
    <p>8.1 本协议的任何修改、变更应经协议各方另行协商，并就修改、变更事项共同签 署书面协议后方可成立。 </p>
    <p>8.2 本协议在下列情况下解除： </p>
    <p>8.2.1 经各方协商一致解除。 </p>
    <p>8.2.2 任何一方发生违约行为并在守约方向其发出书面通知之日起  15日内不予履 行合同的，或累计发生两次或两次以上违约行为的，守约方有权单方面通知解除本协议。 </p>
    <p>8.2.3 因法律规定的不可抗力造成本协议无法继续履行的。 </p>
    <p>8.3 提出解除协议的一方，应当以书面形式通知其他各方。 </p>
    <p>8.4 本协议解除后，不影响守约方要求违约方支付违约金并赔偿损失的权利。 </p>
    <p>8.5 除本协议另有约定外，非经本协议各方协商一致并达成书面协议，任何一方不 得转让其在本协议或本协议项下的全部或部分权利义务。 </p>
    <p>8.6 如果一方出现出借资产的继承或赠与等权利变更需要对方协助办理的，必须由 主张权利的继承人或受赠人等相关人员向对方出示经国家权威机关（公证处或使领馆）公认证的继承或赠与等权利归属证明的文件，对方确认后方予协助办理。由此产生的相关税费，由主张权利的一方负责向相关税务机关申报、缴纳。 </p>
    <h2>九、争议解决</h2>
    <p>9.1 本协议的效力、解释以及履行适应中华人民共和国的法律。 </p>
    <p>9.2 本协议各方因本协议履行发生争议的，均应首先通过友好协商的方式解决，协 商不成的，任何一方均可把争议提交丙方实际经营所在人民法院暨上海市普陀区人民法院诉讼管辖。 </p>
    <h2>十、保密条款</h2>
    <p>10.1 保密人员：任何接触本协议约定的保密信息的人员，均为保密人员。 </p>
    <p>10.2 保密信息的范围： </p>
    <p>10.2.1 保密信息：指信息提供方向接受方提供的，属于提供方或其股东及其他关联 公司所有或专有的，或提供方负有保密义务的有关第三方的资料及所有在信息载体上明确标示“保密”的材料和信息。需保密材料包括但不限于：合同文本正本、副本、附件、复印件及记载的内同，服务项目、收费标准，经营管理模式，客户信息等非 公开的、保密的或专业的信息和数据。 </p>
    <p>10.2.2 保密信息不包括下列信息： </p>
    <p>10.2.2.1 在接受保密信息之时，接受方已经通过其他来源获悉的、无保密限制信息。</p>
    <p>10.2.2.2 一方通过合法行为获悉已经或即将公诸于众的信息。 </p>
    <p>10.2.2.3 根据政府要求、命令和司法条例所披露的信息。 </p>
    <p>10.3 保密义务： </p>
    <p>10.3.1 对保密信息谨慎、妥善持有，并严格保密，没有提供方事先书面同意，不得 向任何第三方披露。 </p>
    <p>10.3.2 接受方仅可为双方合作之必需，将保密信息披露给其指定的第三方公司，并 且该公司应首先以书面形式承诺保守该保密信息。 </p>
    <p>10.3.3 接受方仅可为双方合作业务之必需，将保密信息披露给其直接或间接参与合作事项的管理人员、职员、顾问和其他 雇员（统称“有关人员”），但应保证该类有关人员对保密信息严格保密。 </p>
    <p>10.3.4 若具有权力的法庭或其他司法、行政、立法机构要求一方披露保密信息，接受方将：</p>
    <p>（1）立即通知提供方此类要求； </p>
    <p>（2）若接受方按上述要求必须提供保密信息，接受方将配合提供方采取合法及合理 的措施，要求所提供的保密信息能得到保密的待遇。 </p>
    <p>10.3.5 若接受方或有关人员违反本协议的保密义务，接受方须承担相应责任，并赔 偿提供方由此造成的损失。</p>
    <p>10.4 保密期限：本条规定的保密期限为本协议有效期内和有效期满后的5年。 </p>
    <h2>十一、附则</h2>
    <p>11.1 本协议附件作为本协议的有效组成部分，与本协议效力一致。 </p>
    <p>11.2 本协议的电子件、传真件、复印件、扫描件等经双方确认的有效复本的效力与 本协议原件效力一致。 </p>
    <p>11.3 双方确认，本协议的签署、生效和履行以不违反中国的法律法规为前提。如果 本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。 </p>
    <p>11.4 本协议一式三份，甲乙丙各执一份，具有法律效力。 </p>
    <p> </p><br>
    <p> </p><br>
    <p> </p><br>
    <p>【以下无正文】  </p>
    <p class="mar_btm">请在本页进行签署，并确认已经清楚知晓并了解本合同的所有相关内容。 </p>
    <p class="mar_btm">甲方：<img src="{{asset('/static/common/v0/images/1.png')}}" height="40px"; width="100px"> </p>
    <p class="mar_btm">日期：</p>
    <p>乙方：</p>
    <p class="mar_btm" >日期： </p>
    <div style="position:relative;">丙方：上海高富金融信息服务有限公司
        <div style="position:absolute;"><img src="{{asset('/static/common/v0/images/2.png')}}" height="200px"; width="200px"></div>
    </div>

    <p class="mar_btm">日期：</p>
</div>
</body>
</html>
