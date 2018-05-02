/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/14.
 */
$(function () {
   layui.use(["layer"],function () {
       var layer = layui.layer;
       var apply_id = $("input[name='apply_id']").val();
       //同意
       $("#btn-agree").click(function () {
           var remark = $("textarea[name='asset_ck2_remark']").val();
            layer.confirm("确定通过该项审核吗？",{btn:["确定","取消"]},function () {
               $.post("/assetor/asset/"+apply_id+"/check2",{"result":"agree","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/assetor/asset/check2";
                    }else{
                        layer.msg(re.msg);
                    }
               });
            });
        });
        //拒绝
        $("#btn-ignore").click(function () {
            var remark = $("textarea[name='asset_ck2_remark']").val();
            layer.confirm("确定拒绝该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/assetor/asset/"+apply_id+"/check1",{"result":"ignore","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/assetor/asset/check2";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
   });
});