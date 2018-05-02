/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
   layui.use(["layer","form"],function () {
        var layer = layui.layer,form = layui.form();
        form.verify({
            "bankcard_no":function (val) {
                if(!bank58Validator.bankcard.test(val)){
                    return "申请人银行卡号输入有误";
                }
            },
            "bankcard_type":function (val) {
                if(val == undefined || val.length < 3 ){
                    return "所属银行输入有误,大于4个字符"
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

        form.on("submit(next)",function (data) {
            $.post("/agency/asset/create2",data.field,function (re) {
                if(re.status == 200){
                  //  window.location.href = "/agency/asset/create/step2";
                    window.location.href = "/agency/asset/create/upzip";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
   });
});