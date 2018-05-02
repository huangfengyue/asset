/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/16.
 */
$(function () {
   layui.use(["element","layer","form"],function () {
        var layer = layui.layer,form=layui.form();
        form.verify({
            "username":function (val) {
                if(!bank58Validator.username.test(val)){
                    return "账号校验失败";
                }
            },
            "nickname":function (val) {
                if(val == undefined || val.length < 3 || val.length > 8){
                    return "昵称输入有误，限3-8字符";
                }
            },
            "password":function (val) {
                if(!bank58Validator.password.test(val)){
                    return "密码长度校验失败，限6-15字符";
                }
            },
            "confirm-pwd":function (val) {
                if(val != $("input[name='password']").val()){
                    return "两次密码输入不一致";
                }
            },
            "mobile":function (val) {
                if(!bank58Validator.mobile.test(val)){
                    return "手机号输入有误";
                }
            },
            "email":function (val) {
                if(val == undefined){
                    return "邮箱校验失败，请刷新页面重试";
                }else{
                    if(val.length>0 && !bank58Validator.email.test(val)){
                        return "邮箱验证失败";
                    }
                }

            }
        });

        form.on("submit(submit)",function (data) {
            layer.confirm("确定添加吗？",{btn:["确定","取消"]},function () {
                $.post("/admin/user/create",data.field,function (re) {
                    if(re.status == 200){
                        layer.confirm("添加成功",{btn:["继续添加","返回列表"]},function () {
                            window.location.reload();
                        },function () {
                           window.location.href = "/admin/user";
                        });
                    }else{
                        layer.msg(re.msg);
                    }
                });
            })
        })
   }) ;
});