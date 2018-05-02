/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/agency/asset/check2?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/agency/asset/check2?p="+obj.curr,function (re) {
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
            var phone=$("#phone").val();
            var applier_name=$("#applier_name").val();
            var status=$("#status").val();
            var applier_idcard=$("#applier_idcard").val();
            var apply_amt_final=$("#apply_amt_final").val();
            window.location.href = "/agency/asset/ck2_excel?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final;
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
            $.post("/agency/asset/check2?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/agency/asset/check2?p="+obj.curr+"&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard,function (re) {
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
        var generate = "<a style='color: gray;' href='javascript:;'>生成</a>";
        var check = "<a style='color: gray;' href='javascript:;'>查看</a>";
        var upload = "<a style='color: gray;' href='javascript:;'>上传</a>";
        var refuse = "<a style='color: gray;' href='javascript:;'>拒绝</a>";
        var   updateOrComplet = '/agency/asset/'+ele.apply_id+'/update-complet';
        if(ele.status == 8||ele.status == 9){
            generate = '<a href="/agency/asset/'+ele.apply_id+'/sign" style="color: black">生成</a> ';
            refuse = '<a href="/agency/asset/'+ele.apply_id+'/refuse" style="color: black">拒绝</a> ';
        }
        if(ele.status != 8&&ele.status != 11){
            check = '<a href="/agency/asset/details/'+ele.apply_id+'" style="color: black">查看</a> ';
        }
        if(ele.status == 9){
          //  upload = '<a href="/agency/asset/upload/'+ele.apply_id+'" style="color: black">上传</a> ';
            upload = '<a href="/agency/asset/'+ele.apply_id+'/update-complet" style="color: black">上传</a> ';
        }

        content += "<tr>" +
                "<td>"+ele.apply_no+"</td>" +
                "<td><a href='/agency/asset/"+ele.apply_id+"' >"+ele.applier_name+"</a></td>" +
                "<td>"+ele.applier_mobile+"</td>" +
                "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
                "<td>"+ele.bankcard_no+"</td>" +
                "<td>"+ele.city+"</td>" +
                "<td>"+ele.loan_category+"</td>" +
                "<td>"+ele.apply_amt_final+"</td>" +
                "<td>"+ele.create_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td>'+generate+'&nbsp;&nbsp;&nbsp;'+check+'</td>' +
                '<td>'+upload+'&nbsp;&nbsp;&nbsp;'+refuse+'</td>' +
                "</tr>";
    });
    return content;
}