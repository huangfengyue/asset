/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
        var apply_id = $("input[name='apply_id']").val();
        var repay_id = $("input[name='repay_id']").val();
       $.get("/financer/asset?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/financer/asset?p="+obj.curr,function (re) {
                                if(re.status == 200){
                                    $("#data-table").find("tbody").html(setData(re.data.list))
                                }
                           });
                       }else{
                            $("#data-table").find("tbody").html(setData(re.data.list));
                       }
                   }
               });
           }
       });
        //放款
        $("#btn-loan").click(function () {
            var remark = $("input[name='remark']").val();
            layer.confirm("确定放款吗？",{btn:["确定","取消"]},function () {
                $.post("/financer/asset/"+apply_id+"/finish-loan",{"result":"agree","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/financer/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
        //拒绝
        $("#btn-ignore").click(function () {
            var remark = $("textarea[name='remark']").val();
            layer.confirm("确定拒绝该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/financer/asset/"+apply_id+"/finish-loan",{"result":"ignore","remark":remark},function (re) {
                    if(re.status == 200){
                        window.location.href = "/financer/asset";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
        //还款
        $("#btn-repay").click(function () {
            var status = $("select[name='status']").val();
            var real_amt_all = $("input[name='real_amt_all']").val();
            var apply_week_now = $("input[name='apply_week_now']").val();
            var apply_week_num = $("input[name='apply_week_num']").val();
            var apply_week_amt = $("input[name='apply_week_amt']").val();
            layer.confirm("确定该项审核吗？",{btn:["确定","取消"]},function () {
                $.post("/financer/asset/"+repay_id+"/repays",{"apply_week_amt":apply_week_amt,"apply_week_num":apply_week_num,"apply_week_now":apply_week_now,"id":repay_id,"real_amt_all":real_amt_all,"status":status},function (re) {
                    if(re.status == 200){
                        window.location.href = "/financer/asset/"+repay_id+"/repay";
                    }else{
                        layer.msg(re.msg);
                    }
                });
            });
        });
    });

});
function SendForms ()
{
    $(function () {
        layui.use(["layer"],function () {
            layer = layui.layer;
            var applier_name=$("#applier_name").val();
            var time1=$("#time1").val();
            var time2=$("#time2").val();
            var time=$("#time").val();
            var cktime1=$("#cktime1").val();
            var cktime2=$("#cktime2").val();
            var cktime=$("#cktime").val();
            window.location.href = "/financer/asset/list_excel?p=1&time1="+time1+"&time2="+time2+"&time="+time+"&applier_name="+applier_name+"&cktime2="+cktime2+"&cktime="+cktime+"&cktime1="+cktime1;
            return false;


        });
    });
}
function SendForm ()
{
    $(function () {
        layui.use(["laypage","layer"],function () {
            var laypage = layui.laypage,layer = layui.layer;
            var applier_name=$("#applier_name").val();
            var time=$("#time").val();
            var time1=$("#time1").val();
            var time2=$("#time2").val();
            var cktime1=$("#cktime1").val();
            var cktime2=$("#cktime2").val();
            var cktime=$("#cktime").val();
            $.post("/financer/asset?p=1&time="+time+"&time1="+time1+"&time2="+time2+"&applier_name="+applier_name+"&cktime2="+cktime2+"&cktime="+cktime+"&cktime1="+cktime1,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/financer/asset?p="+obj.curr+"&time="+time+"&time1="+time1+"&time2="+time2+"&applier_name="+applier_name+"&cktime2="+cktime2+"&cktime="+cktime+"&cktime1="+cktime1,function (re) {
                                    if(re.status == 200){
                                        $("#data-table").find("tbody").html(setData(re.data.list))
                                    }
                                });
                            }else{
                                $("#data-table").find("tbody").html(setData(re.data.list));
                            }
                        }
                    });
                }
            });

        });
    });
}
//设置数据
function setData(list) {
    var content = "";
    $(list).each(function (index,ele) {
        var btnCheck = "<a style='color: gray;' href='javascript:;'>放款</a>"
        if(ele.status == 10&&ele.role_id != 1){
             btnCheck = '<a href="/financer/asset/'+ele.apply_id+'/finish-loan" >放款</a> ';
        }
        var details = '<a href="/financer/asset/details/'+ele.apply_id+'">查看</a>';
        if(ele.status == 1||ele.status == 2||ele.status == 3){
            details = "<a style='color: gray;' href='javascript:;'>查看</a>"
        }
        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td>"+ele.city+"</td>" +
                "<td>"+ele.city_num+"</td>" +
               "<td>"+ele.applier_name+"</td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.apply_amt_all+"</td>" +
                "<td>"+ele.apply_amt_final+"</td>" +
                "<td>"+ele.apply_real_amt+"</td>" +
                "<td>"+ele.bankcard_no+"</td>" +
                "<td>"+ele.finish_loan_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td>'+btnCheck+'|<a href="/financer/asset/'+ele.apply_id+'">查看</a></td>' +
                 '<td>'+details+'</td>' +
                "</tr>";
    });
    return content;
}

//发标
function finishLoan(apply_id) {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.prompt({
            formType: 2,
            title: '请输入确认放款的备注信息',
        }, function(remark){
           $.post("/financer/asset/"+apply_id+"/finish-loan",{"remark":remark},function (re) {
                if(re.status == 200){
                    layer.confirm("已更改",{btn:["确定"]},function () {
                       window.location.reload();
                    });
                }else{
                    layer.msg(re.msg);
                }
           });
        });
    });
}

