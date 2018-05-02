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
            }
        });

        form.on("submit(next)",function (data) {
            $.post("/agency/asset/create",data.field,function (re) {
                if(re.status == 200){
                    //  window.location.href = "/agency/asset/create/step2";
                    window.location.href = "/agency/asset/create1";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
});