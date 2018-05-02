/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
    layui.use(["layer","form"],function () {
        var layer = layui.layer,form = layui.form();
        form.verify({

        });

        form.on("submit(next)",function (data) {
            $.post("/agency/asset/loan_category",data.field,function (re) {
                if(re.status == 200){
                    //  window.location.href = "/agency/asset/create/step2";
                    window.location.href = "/agency/asset/create";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
});