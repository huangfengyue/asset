/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/14.
 */
$(function () {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        var apply_id = $("input[name='apply_id']").val();
        //同意
        $("#btn-agree").click(function () {
            var remark = $("input[name='remark']").val();
            layer.confirm("确定通过该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/zhongshen/asset/"+apply_id+"/update",{"remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/zhongshen/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
        //拒绝
        $("#btn-ignore").click(function () {
            var remark = $("input[name='remark']").val();
            layer.confirm("确定拒绝该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/zhongshen/asset/"+apply_id+"/update",{"result":"ignore","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/zhongshen/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
        //退回
        $("#btn-back").click(function () {
            var remark = $("input[name='remark']").val();
            layer.confirm("确定退回该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/zhongshen/asset/"+apply_id+"/update",{"result":"back","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/zhongshen/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
    });
});