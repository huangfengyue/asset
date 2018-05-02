/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/14.
 */
$(function () {
   layui.use(["layer"],function () {
       var layer = layui.layer;
       var apply_id = $("input[name='apply_id']").val();
       //同意
       $("#btn-agree").click(function () {
           var remark = $("textarea[name='riskctl_ck1_remark']").val();
            layer.confirm("确定通过该项审核吗？",{btn:["确定","取消"]},function () {
               $.post("/riskctl/asset/"+apply_id+"/check1",{"result":"agree","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/riskctl/asset";
                    }else{
                        layer.msg(re.msg);
                    }
               });
            });
        });
       //签约
       $("#btn-sign").click(function () {
           layer.confirm("确定签约吗？",{btn:["确定","取消"]},function () {
               $.post("/riskctl/asset/"+apply_id+"/sign",{"result":"agrees",},function (re) {
                   if(re.status == 200){
                       window.location.href = "/riskctl/asset";
                   }else{
                       layer.msg(re.msg);
                   }
               });
           });
       });
        //拒绝
        $("#btn-ignore").click(function () {
            var remark = $("textarea[name='riskctl_ck1_remark']").val();
            layer.confirm("确定拒绝该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/riskctl/asset/"+apply_id+"/check1",{"result":"ignore","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/riskctl/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });

        //退回修改
       $("#btn-modify").click(function () {
           var remark = $("textarea[name='riskctl_ck1_remark']").val();
           layer.confirm("确定退回让客户修改资料吗？",{btn:["确定","取消"]},function () {
              $.post("/riskctl/asset/"+apply_id+"/check1",{"result":"modify","remark":remark},function (re) {
                  if(re.status == 200){
                      window.location.href = "/riskctl/asset";
                  }else{
                      layer.msg(re.msg);
                  }
              });
           });
       });
   });
});