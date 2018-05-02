/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/assetor/asset/repay?p=1",function (re) {
            if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/assetor/asset/repay?p="+obj.curr,function (re) {
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

//设置数据
function setData(list) {
    var content = "";
    $(list).each(function (index,ele) {
        var  btnCheck = '<a href="/financer/asset/'+ele.id+'/repay">还款</a> '
        if(ele.status == 2||ele.status == 3||ele.status == 5){
             btnCheck = "<a style='color: gray;' href='javascript:;'>还款</a>";
        }
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+ele.applier_name+"</td>" +
            "<td>"+ele.loan_category+"</td>" +
            "<td>"+ele.apply_real_amt+"</td>" +
            "<td>"+ele.apply_week_num+"</td>" +
            "<td>"+ele.apply_week_now+"</td>" +
            "<td>"+ele.apply_week_amt+"</td>" +
            // "<td>"+ele.apply_week_service_amt+"</td>" +
            "<td>"+ele.repay_late_days+"</td>" +
            "<td>"+ele.repay_late_amt+"</td>" +
            "<td>"+ele.now_amt_all+"</td>" +
            "<td>"+ele.bankcard_no+"</td>" +
            "<td>"+ele.time+"</td>" +
            "<td>"+ele.status_name+"</td>" +
            '<td><a href="/assetor/asset/caiwu/'+ele.apply_id+'">查看</a></td>' +
            // '<td><a href="/financer/asset/repay/'+ele.apply_id+'">还款</a></td>' +
            "</tr>";
    });
    return content;
}
