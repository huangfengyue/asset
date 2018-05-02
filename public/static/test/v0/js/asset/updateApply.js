/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/13.
 */
$(function(){
    layui.use(["layer","form"],function () {
        var layer = layui.layer,form = layui.form();
        form.verify({
            "apply_amt":function (val) {
                if(val == undefined || val == "" || val <= 99 || val > 100000){
                    return '借款金额输入有误，范围在99-10万之间的整数';
                }
            },
            "applier_age":function (val) {
                if(val == undefined || val == "" || val < 18 ){
                    return '年龄输入有误，应大于18';
                }
            },
            "applier_address":function (val) {
                if(val == undefined || val.length < 3){
                    return '现住址输入有误';
                }
            },
            "applier_name":function (val) {
                if(val == undefined || val.length < 2 ){
                    return "申请人姓名输入有误";
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
            "support_people":function (val) {
                if(val == undefined || val == "" ){
                    return "供养人数输入有误";
                }
            },
            "childs":function (val) {
                if(val == undefined || val == "" ){
                    return "子女数目输入有误";
                }
            },
            "origin_address":function (val) {
                if(val == undefined || val.length < 3 ){
                    return "户籍地址输入有误"
                }
            },
            "relative_name":function (val) {
                if(val == undefined || val.length < 2 ){
                    return "关系人姓名输入有误";
                }
            },
            "relative_address":function (val) {
                if(val == undefined || val.length < 3){
                    return "家庭地址输入有误";
                }
            },
            "relative_address1":function (val) {
                if(val == undefined || val.length < 3){
                    return "家庭地址输入有误";
                }
            },
            "relative_phone":function (val) {
                if(!bank58Validator.mobile.test(val)){
                    return "关系人手机号输入有误";
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
            "applier_week_amt":function (val) {
                if(val == undefined || val == "" || val <= 99 || val > 100000){
                    return "每周最高还款金额输入有误，范围在99-10万之间的整数";
                }
            },
           "survey_name":function (val) {
            if(val == undefined || val.length < 2 ){
                return "客户经理姓名输入有误";
            }
            },
            "survey_phone":function (val) {
                if(!bank58Validator.mobile.test(val)){
                    return "客户经理手机号输入有误";
                }
            }
        });

        form.on("submit(save)",function (data) {
            layer.confirm("确定要修改吗？",{btn:["确定","取消"]},function () {
                $.post($("form[name='form']").prop("action"),data.field,function (re) {
                    if(re.status == 200){
                        window.location.reload();
                    }else{
                        layer.msg(re.msg);
                    }
                });
            })
        });
    });
});