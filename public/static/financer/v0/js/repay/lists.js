/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/financer/repay?p=1",function (re) {
            if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/financer/repay?p="+obj.curr,function (re) {
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
            var applier_name=$("#applier_name").val();
            var status=$("#status").val();
            window.location.href = "/financer/repay/repay_excel?p=1&applier_name="+applier_name+"&status="+status;
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
            var status=$("#status").val();
            $.post("/financer/repay?p=1&applier_name="+applier_name+"&status="+status,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/financer/repay?p="+obj.curr+"&applier_name="+applier_name+"&status="+status,function (re) {
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
        var   btnCheck = "<a style='color: gray;' href='javascript:;'>还款</a>";
        if((ele.status != 2)&&(ele.status != 3)&&(ele.status != 5)&&(ele.role_id != 1)){

            btnCheck = '<a href="/financer/asset/'+ele.id+'/repay" style="color: black;">还款</a> '

        }
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+ele.city+"</td>" +
            "<td>"+ele.city_num+"</td>" +
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
            '<td>'+btnCheck+'<a href="/financer/asset/caiwu/'+ele.apply_id+'" style="color: black;">查看</a></td>' +
            // '<td><a href="/financer/asset/repay/'+ele.apply_id+'">还款</a></td>' +
            "</tr>";
    });
    return content;
}
