/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/16.
 */
$(function(){
    layui.use(["laypage","layer"],function () {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/admin/user?p=1",function (re) {
           if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/admin/user?p="+obj.curr,function (re) {
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
function SendForm ()
{
    $(function () {
        layui.use(["laypage","layer"],function () {
            var laypage = layui.laypage,layer = layui.layer;
            var phone=$("#phone").val();
            var district=$("#district").val();
            var city=$("#city").val();
            var status=$("#status").val();
            var username=$("#username").val();
            $.post("/admin/user?p=1&city="+city+"&phone="+phone+"&status="+status+"&district="+district+"&username="+username,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/admin/user?p="+obj.curr+"&city="+city+"&phone="+phone+"&status="+status+"&district="+district+"&username="+username,function (re) {
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
function setData(list) {
    var content = "";
    $(list).each(function (index,ele) {
        content += "<tr><td>"+ele.user_id+"</td>" +
                "<td>"+ele.username+"</td>" +
                "<td>"+ele.district+"</td>" +
                "<td>"+ele.city+"</td>"+
                "<td>"+ele.city_num+"</td>"+
                "<td>"+ele.mobile+"</td>"+
                "<td>"+ele.role_name+"</td>"+
                "<td>"+ele.status_name+"</td>"+
                // '<td>' +
            //'<a href="/admin/user/1" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="查看" data-placement="top">' +
                    // '<i class="fa fa-eye"></i></a> <a href="javascript:;" data-id="1" class="btn btn-outline btn-xs btn-default tooltips reset_password" data-container="body" data-original-title="重置密码" data-placement="top">' +
                 //    '<i class="fa fa-lock"></i></a> ' +
            // '<a href="/admin/user/'+ele.user_id+'/update" class="btn btn-xs btn-outline btn-warning tooltips" data-original-title="修改" data-placement="top"><i class="fa fa-edit"></i></a>' +
            // '<a href="javascript:;" onclick="deleteApply('+ele.user_id+')" class="btn btn-xs btn-outline btn-danger tooltips destroy_item" data-original-title="删除" data-placement="top"><i class="fa fa-trash"></i></a> </td>' +
            //
            "</tr>";
    });
   // $("#data-table").find("tbody").html(content);
    return content;
}

//删除
function deleteApply(apply_id) {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.confirm("确定要删除吗？",{btn:["确定","取消"]},function () {
            $.post("/admin/user/"+apply_id+"/del",{},function (re) {
                if(re.status == 200){
                    layer.confirm("已删除",{btn:["确定"]},function () {
                        window.location.reload();
                    });
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
}