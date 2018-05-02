/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/14.
 */
$(function () {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        var apply_id = $("input[name='apply_id']").val();
        //同意
        $("#btn-agree").click(function () {
            var remark = $("textarea[name='riskctl_ck2_remark']").val();
            layer.confirm("确定通过该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/riskctl/asset/"+apply_id+"/check2",{"result":"agree","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/riskctl/asset/check2";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
        //拒绝
        $("#btn-ignore").click(function () {
            var remark = $("textarea[name='riskctl_ck2_remark']").val();
            layer.confirm("确定拒绝该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/riskctl/asset/"+apply_id+"/check2",{"result":"ignore","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/riskctl/asset/check2";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });

        $("#btn-modify").click(function () {
           var remark =  $("textarea[name='riskctl_ck2_remark']").val();
           layer.confirm("确定退回该次申请要客户修改二审时候填写的资料吗？",{btn:["确定","取消"]},function () {
               $.post("/riskctl/asset/"+apply_id+"/check2",{"result":"modify","remark":remark},function (re) {
                  if(re.status == 200){
                      window.location.href = "/riskctl/asset/check2";
                  } else{
                      layer.msg(re.msg);
                  }
               });
           })
        });
    });
});
