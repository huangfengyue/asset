/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/16.
 */
$(function () {
    layui.use(["element","layer","form"],function () {
        var layer = layui.layer,form=layui.form();
        var user_id = $("input[name='user_id']").val();
        form.verify({
            "username":function (val) {
                if(!bank58Validator.username.test(val)){
                    return "账号校验失败";
                }
            },
            "mobile":function (val) {
                if(!bank58Validator.mobile.test(val)){
                    return "手机号输入有误";
                }
            }
        });

        form.on("submit(submit)",function (data) {
            layer.confirm("确定修改吗？",{btn:["确定","取消"]},function () {
                $.post("/admin/user/"+user_id+"/update",data.field,function (re) {
                    if(re.status == 200){
                        window.location.href = "/admin/user";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            })
        })
    }) ;
});