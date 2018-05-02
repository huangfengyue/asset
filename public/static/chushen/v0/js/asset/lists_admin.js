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
    $(list).each(function () {

    });
}