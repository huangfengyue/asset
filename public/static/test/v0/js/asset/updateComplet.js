/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
    layui.use(["layer","form"],function () {
        var form = layui.form(),layer = layui.layer;
        form.on("submit(submit)",function (data) {
            if($("input[name='zip']").val() == undefined || $("input[name='zip']").val().length < 1){
                layer.msg("请上传有效的压缩包");return false;
            }
            layer.confirm("确定要提交吗？",{btn:["确定","取消"]},function () {
                layer.load();
                $("form[name='cert-form']").submit();
            });
            return false;
        });
    });
});