/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/fushen/repay?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/fushen/repay?p="+obj.curr,function (re) {
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
function SendForms ()
{
    $(function () {
        layui.use(["layer"],function () {
            layer = layui.layer;
            var time1=$("#time1").val();
            var time2=$("#time2").val();
            var times=$("#times").val();
            window.location.href = "/fushen/repay/repay_excel?p=1&time1="+time1+"&time2="+time2+"&times="+times;
            return false;


        });
    });
}
function SendForm ()
{
    $(function () {
        layui.use(["laypage","layer"],function () {
            var laypage = layui.laypage,layer = layui.layer;
            var times=$("#times").val();
            var time1=$("#time1").val();
            var time2=$("#time2").val();
            $.post("/fushen/repay?p=1&times="+times+"&time1="+time1+"&time2="+time2,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/fushen/repay?p="+obj.curr+"&times="+times+"&time1="+time1+"&time2="+time2,function (re) {
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
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+ele.applier_name+"</td>" +
            "<td>"+ele.loan_category+"</td>" +
            "<td>"+ele.apply_real_amt+"</td>" +
            "<td>"+ele.apply_week_num+"</td>" +
            "<td>"+ele.apply_week_now+"</td>" +
            "<td>"+ele.apply_week_amt+"</td>" +
            "<td>"+ele.apply_week_service_amt+"</td>" +
            "<td>"+ele.repay_late_days+"</td>" +
            "<td>"+ele.repay_late_amt+"</td>" +
            "<td>"+ele.now_amt_all+"</td>" +
            "<td>"+ele.bankcard_no+"</td>" +
            "<td>"+ele.time+"</td>" +
            "<td>"+ele.status_name+"</td>" +
            '<td><a href="/fushen/asset/caiwu/'+ele.apply_id+'" style="color: black;">查看</a></td>' +
            // '<td><a href="/financer/asset/repay/'+ele.apply_id+'">还款</a></td>' +
            "</tr>";
    });
    return content;
}


