/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage"],function () {
        var laypage = layui.laypage,layer = layui.layer;
        $.get("/financer/asset/check2?p=1",function (re) {
            if(re.status == 200){
                laypage({
                    cont: 'pager-nav'
                    ,pages: re.data.pager.totalPage
                    ,jump: function(obj, first){
                        if(!first){
                            $.get("/financer/asset/check2?p="+obj.curr,function (re) {
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
        var btnCheck = "<a style='color: gray;' href='javascript:;'>审核</a>";
        if(ele.status == 5){
            btnCheck = '<a href="/assetor/asset/'+ele.apply_id+'/check2" '+(ele.status != 1?"disabled='disabled' ":"")+'>审核</a> ';
        }
        content += "<tr>" +
            "<td>"+ele.apply_no+"</td>" +
            "<td>"+ele.applier_mobile+"</td>" +
            "<td>"+ele.survey_name+"</td>" +
            "<td>"+ele.apply_amt+"</td>" +
            "<td>"+ele.deadline+(ele.deadline_type==1?" 天":" 月")+"</td>" +
            "<td>"+ele.bankcard_no+"</td>" +
            "<td>"+ele.loan_category+"</td>" +
            "<td>"+ele.create_time+"</td>" +
            "<td>"+ele.status_name+"</td>" +
            '<td>'+btnCheck+'<a href="/assetor/asset/'+ele.apply_id+'">查看</a></td>' +
            '<td><a href="/financer/asset/details/'+ele.apply_id+'">查看</a></td>' +
            "</tr>";
    });
    return content;
}