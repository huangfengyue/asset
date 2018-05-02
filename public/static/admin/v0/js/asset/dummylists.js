/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/admin/user/dummyLists?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pageCount
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/admin/user/dummyLists?p="+obj.curr,function (re) {
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
            "<td>"+ele.username+"</td>" +
            "<td>"+ele.phone+"</td>" +
            "<td>"+'<img src="'+ele.ewm_img+'" style="height:100px;weight:100px"/>'+"</td>" +
            "<td>"+ele.add_time+"</td>" +
            '<td><a href="/chushen/asset/'+ele.id+'" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="查看" data-placement="top"><i class="fa fa-eye"></i></a>'+
            "</tr>";
    });
    return content;
}