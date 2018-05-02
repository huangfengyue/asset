/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function() {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/chushen/asset?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/chushen/asset?p="+obj.curr,function (re) {
                                if(re.status == 200){
                                    $("#data-table").find("tbody").html(setData(re.data.list));
                                    $("#ibox-title").find("span").html(re.data.count);
                                }
                           });
                       }else{
                            $("#data-table").find("tbody").html(setData(re.data.list));
                           $("#ibox-title").find("span").html(re.data.count);
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
            var phone=$("#phone").val();
            var applier_name=$("#applier_name").val();
            var status=$("#status").val();
            var applier_idcard=$("#applier_idcard").val();
            var apply_amt_final=$("#apply_amt_final").val();
            window.location.href = "/chushen/asset/list_excel?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final;
            return false;


        });
    });
}
function SendForm ()
{
    $(function () {
        layui.use(["laypage","layer"],function () {
            var laypage = layui.laypage,layer = layui.layer;
            var phone=$("#phone").val();
            var applier_name=$("#applier_name").val();
            var status=$("#status").val();
            var applier_idcard=$("#applier_idcard").val();
            $.get("/chushen/asset?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.get("/chushen/asset?p="+obj.curr+"&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
                                    if(re.status == 200){
                                        $("#data-table").find("tbody").html(setData(re.data.list));
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
        var btnCheck = "<a style='color: gray;' href='javascript:;'>修改</a>";
         var jlx = '<i class="layui-icon">&#x1006;</i>';
        var applier_name ="<a href='/chushen/asset/"+ele.apply_id+"' >"+ele.applier_name+"</a>"
        if(ele.status == 1&&ele.role_id != 1){
            btnCheck = '<a href="/chushen/asset/'+ele.apply_id+'/update" >修改</a> ';
        }
        if(ele.jlx == "yes"){
            jlx = '<i class="layui-icon">&#xe605;</i>'
        }
        if(ele.flag==1||ele.flag1==1||ele.flag2==1||ele.flag3==1||ele.flag4==1){
            applier_name ="<a href='/chushen/asset/"+ele.apply_id+"' style='color:red'>"+ele.applier_name+"</a>"
        }
        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td>"+ele.district+"</td>" +
                "<td>"+ele.city+"</td>" +
                "<td>"+ele.city_num+"</td>" +
                "<td>"+applier_name+"</td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.applier_idcard+"</td>" +
                "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
                "<td>"+ele.loan_category+"</td>" +
                "<td>"+ele.create_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td>'+jlx+'</td>' +
                '<td>'+btnCheck+'</td>' +
                "</tr>";
    });
    return content;
}

//删除
function deleteApply(apply_id) {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.confirm("确定要删除吗？",{btn:["确定","取消"]},function () {
            $.post("/chushen/asset/"+apply_id+"/del",{},function (re) {
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