/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/operator/asset?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                   ,pages: re.data.pager.totalPage
                   ,jump: function(obj, first){
                       if(!first){
                           $.get("/operator/asset?p="+obj.curr,function (re) {
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
        var btnCheck = "<a style='color: gray;' href='javascript:;'>--</a>"
        if(ele.status == 7){
             btnCheck = '<a href="javascript:;"  onclick="publish('+ele.apply_id+')" >发标</a> ';
        }else if (ele.status == 8){
            btnCheck = '<a href="javascript:;"  onclick="fullApply('+ele.apply_id+')" >满标</a>'
        }
        var details = '<a href="/operator/asset/details/'+ele.apply_id+'">查看</a>';
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
                "<td>"+ele.create_time+"</td>" +
                "<td>"+ele.status_name+"</td>" +
                '<td>'+btnCheck+'|<a href="/operator/asset/'+ele.apply_id+'">查看</a></td>' +
                 '<td>'+details+'</td>' +
                "</tr>";
    });
    return content;
}

//发标
function publish(apply_id) {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.prompt({
            formType: 2,
            title: '请输入备注信息',
        }, function(remark){
           $.post("/operator/asset/"+apply_id+"/publish",{"remark":remark},function (re) {
                if(re.status == 200){
                    layer.confirm("已更改",{btn:["确定"]},function () {
                       window.location.reload();
                    });
                }else{
                    layer.msg(re.msg);
                }
           });
        });
    });
}

//满标
function fullApply(apply_id) {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.prompt({
            formType: 2,
            title: '满标确认信息：我确定',
        }, function(remark){
            if(remark != "我确定"){
                layer.msg("确认信息输入有误");return false;
            }
            $.post("/operator/asset/"+apply_id+"/full",{},function (re) {
                if(re.status == 200){
                    layer.confirm("已更改",{btn:["确定"]},function () {
                        window.location.reload();
                    });
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
}