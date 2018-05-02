/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
   layui.use(["layer","form"],function () {
        var layer = layui.layer,form = layui.form();
        form.verify({
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
           "relative_phone":function (val) {
               if(!bank58Validator.mobile.test(val)){
                   return "关系人手机号输入有误";
               }
           }
        });

        form.on("submit(next)",function (data) {
            $.post("/agency/asset/create1",data.field,function (re) {
                if(re.status == 200){
                  //  window.location.href = "/agency/asset/create/step2";
                    window.location.href = "/agency/asset/create2";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
   });
});