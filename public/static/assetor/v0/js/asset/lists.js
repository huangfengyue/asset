/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/assetor/asset?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/assetor/asset?p="+obj.curr,function (re) {
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
        var btnCheck = '<a href="/assetor/asset/'+ele.apply_id+'/check1" '+(ele.status != 1?"disabled='disabled' ":"")+'>审核</a> ';
         var details = '<a href="/assetor/asset/details/'+ele.apply_id+'">查看</a>';
        if(ele.status != 1){
            btnCheck = "<a style='color: gray;' href='javascript:;'>审核</a>"
        }
        if(ele.status == 1||ele.status == 2||ele.status == 3){
             details = "<a style='color: gray;' href='javascript:;'>查看</a>"
        }


        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td>"+ele.applier_name+"</td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.apply_amt+"</td>" +
                "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
                "<td>"+ele.bankcard_no+"</td>" +
                "<td>"+ele.city+"</td>" +
                "<td>"+ele.loan_category+"</td>" +
                "<td>"+ele.apply_amt_final+"</td>" +
                "<td>"+ele.create_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td>'+btnCheck+'<a href="/assetor/asset/'+ele.apply_id+'">查看</a></td>' +
                '<td>'+details+'</td>' +
                "</tr>";
    });
    return content;
}