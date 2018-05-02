/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/fushen/asset/repay?p=1",function (re) {
            if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/fushen/asset/repay?p="+obj.curr,function (re) {
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
            window.location.href = "/fushen/asset/repay_excel?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final;
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
            var apply_amt_final=$("#apply_amt_final").val();
            $.post("/fushen/asset/repay?p=1&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final,function (re) {
                if(re.status == 200){
                    laypage({
                        cont: 'pager-nav'
                        ,pages: re.data.pager.totalPage
                        ,jump: function(obj, first){
                            if(!first){
                                $.post("/fushen/asset/repay?p="+obj.curr+"&applier_name="+applier_name+"&phone="+phone+"&status="+status+"&applier_idcard="+applier_idcard+"&apply_amt_final="+apply_amt_final,function (re) {
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
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+ele.district+"</td>" +
            "<td>"+ele.city+"</td>" +
            "<td>"+ele.city_num+"</td>" +
            "<td><a href='/fushen/asset/"+ele.apply_id+"' >"+ele.applier_name+"</a></td>" +
            "<td>"+ele.applier_mobile+"</td>" +
            "<td>"+ele.applier_idcard+"</td>" +
            "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
            "<td>"+ele.loan_category+"</td>" +
            "<td>"+ele.apply_amt_final+"</td>" +
            "<td>"+ele.finish_loan_time+"</td>" +
            '<td><a href="/fushen/asset/details/'+ele.apply_id+'">查看</a></td>' +
            "</tr>";
    });
    return content;
}