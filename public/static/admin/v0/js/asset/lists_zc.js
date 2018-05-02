/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/asset?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pageCount
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/asset?p="+obj.curr,function (re) {
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
        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.clerk_name+"</td>" +
                "<td>"+ele.apply_amt+"</td>" +
                "<td>"+ele.deadline+(ele.deadline==1?" 天":" 月")+"</td>" +
                "<td>"+ele.bankcard_no+"</td>" +
                "<td>公务员贷</td>" +
                "<td>"+ele.create_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td><a href="/asset/'+ele.apply_id+'/check1" '+(ele.status != 1?"disabled='disabled'":"")+'>审核</a> <a>查看</a></td>' +
                "</tr>";
    });
    return content;
}