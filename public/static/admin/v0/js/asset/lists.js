/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/7.
 */
$(function () {
    layui.use(["laypage","layer"],function () {
       var laypage = layui.laypage,layer = layui.layer;
       $.get("/admin/user?p=1",function (re) {
           if(re.status == 200){
               laypage({
                   cont: 'pager-nav'
                  // ,pages: re.data.pager.totalRows
                   ,pages: re.data.pager.totalPage
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

//设置数据
function setData(list) {
    var content = "";
    $(list).each(function (index,ele) {
        if(ele.status == 1){
            btnCheck = '通过';
        }else if(ele.status == 2){
            btnCheck = '待审核';
        }else if(ele.status == 3){
            btnCheck = '修改待审核';
        }else if(ele.status == 4){
            btnCheck = '修改审核未通过';
        }else{
            btnCheck = '未通过';
        }
        content += "<tr>" +
                "<td>"+ele.true_name+"</td>" +
                "<td>"+'<img src="'+ele.head_img_url+'" style="height:30px;weight:30px"/>'+"</td>" +
                "<td>"+(ele.type==1?" 个人":" 企业")+"</td>" +
                "<td>"+ele.mobile+"</td>" +
                "<td>"+ele.identity_card+"</td>" +
                "<td>"+'<img src="'+ele.identity_card_image_front_url+'" style="height:30px;weight:30px"/>'+"</td>" +
                "<td>"+'<img src="'+ele.identity_card_image_back_url+'" style="height:30px;weight:30px"/>'+"</td>" +
            "<td>"+btnCheck+"</td>" +
            "<td>"+btnCheck+"</td>" +
                "<td>"+ele.modify_time+"</td>" +
                '<td><a href="/chushen/asset/'+ele.id+'" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="查看" data-placement="top"><i class="fa fa-eye"></i></a>'+
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