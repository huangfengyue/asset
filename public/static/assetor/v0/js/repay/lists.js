/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/assetor/repay?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/assetor/repay?p="+obj.curr,function (re) {
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
        var btnCheck = "<a style='color: gray;' href='javascript:;'>放款</a>"
        if(ele.status == 8){
             btnCheck = '<a href="javascript:;"  onclick="finishLoan('+ele.apply_id+')" >放款</a> ';
        }
        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td>"+ele.applier_name+"</td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.apply_amt+"</td>" +
                "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
                "<td>"+ele.city+"</td>" +
                "<td>"+ele.loan_category+"</td>" +
                "<td>"+ele.apply_amt_final+"</td>" +
                "<td>"+ele.finish_loan_time+"</td>" +
                "<td>等本等息</td>" +
                '<td><a href="/assetor/asset/'+ele.apply_id+'">查看</a></td>' +
                '<td><a href="/assetor/asset/details/'+ele.apply_id+'">查看</a></td>' +
                "</tr>";
    });
    return content;
}
