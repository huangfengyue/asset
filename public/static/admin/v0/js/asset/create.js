/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
   layui.use(["layer","form"],function () {
        var layer = layui.layer,form = layui.form();
        form.verify({
            "apply_amt":function (val) {
                if(val == undefined || val == "" || val <= 99 || val > 100000){
                    return '借款金额输入有误，范围在99-10万之间的整数';
                }
            },
            "deadline":function (val) {
                if(val == undefined || val == "" || val < 1 || val > 1000){
                    return "期限输入有误，范围在1-1000之间的整数";
                }
            },
            "applier_mobile":function (val) {
                if(!bank58Validator.mobile.test(val)){
                    return "申请人手机号输入有误";
                }
            },
            "applier_idcard":function (val) {
                if(!bank58Validator.idcard.test(val)){
                    return "申请人身份证号码有误";
                }
            },
            "bankcard_no":function (val) {
                if(!bank58Validator.bankcard.test(val)){
                    return "申请人银行卡号输入有误";
                }
            },
            "bankcard_type":function (val) {
                if(val == undefined || val.length < 3 ||val.length > 8){
                    return "所属银行输入有误,限4-8个字符"
                }
            },
            "clerk_name":function (val) {
                if(val == undefined || val.length < 3 || val.length > 15){
                    return "渠道方输入有误，限3-15字符";
                }
            }
        });

        form.on("submit(next)",function (data) {
            $.post("/chushen/asset/create",data.field,function (re) {
                if(re.status == 200){
                    window.location.href = "/chushen/asset/create/step2";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
   });
});