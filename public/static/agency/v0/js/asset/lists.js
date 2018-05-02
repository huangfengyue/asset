/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function() {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/agency/asset?p=1",function (re) {
            if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/agency/asset?p="+obj.curr,function (re) {
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
            window.location.href = "/agency/asset/list_excel?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final;
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
            $.post("/agency/asset?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/agency/asset?p="+obj.curr+"&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
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
        var btnCheck = "<a style='color: gray;' href='javascript:;'>修改</a>";
        var jlx = '<a href="/agency/asset/'+ele.apply_id+'/jlx_update" ><i class="layui-icon">&#x1006;</i></a>';
        var applier_name ="<a href='/agency/asset/"+ele.apply_id+"' >"+ele.applier_name+"</a>"
        if((ele.status == 1||ele.status == 7)&&(ele.role_id != 1)){
            btnCheck = '<a href="/agency/asset/'+ele.apply_id+'/update" >修改</a> ';
        }
        if(ele.jlx == "yes"){
            jlx = '<i class="layui-icon">&#xe605;</i>'
        }
        if(ele.flag==1||ele.flag1==1||ele.flag2==1||ele.flag3==1||ele.flag4==1){
            applier_name ="<a href='/agency/asset/"+ele.apply_id+"' style='color:red'>"+ele.applier_name+"</a>"
        }
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+applier_name+"</td>" +
            "<td>"+ele.applier_mobile+"</td>" +
            "<td>"+ele.applier_idcard+"</td>" +
            "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
            "<td>"+ele.loan_category+"</td>" +
            "<td>"+ele.create_time+"</td>" +
            "<td>"+ele.status_name+"</td>" +
            // '<td><a href="/agency/asset/'+ele.apply_id+'" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="查看" data-placement="top"><i class="fa fa-eye"></i></a>'+
            //     ' <a href="/agency/asset/'+ele.apply_id+'/update" class="btn btn-xs btn-outline btn-warning tooltips" data-original-title="修改" data-placement="top"><i class="fa fa-edit"></i></a> '+
            //     '<a href="javascript:;" onclick="deleteApply('+ele.apply_id+')" class="btn btn-xs btn-outline btn-danger tooltips destroy_item" data-original-title="删除" data-placement="top"><i class="fa fa-trash"></i></a> </td>' +
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
            $.post("/agency/asset/"+apply_id+"/del",{},function (re) {
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