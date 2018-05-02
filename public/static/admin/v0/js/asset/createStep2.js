/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
   layui.use(["layer","form"],function () {
       var form = layui.form(),layer = layui.layer;
       form.on("submit(submit)",function (data) {
            $("input[name='require-type']").each(function(index,ele){
                var type_id = $(ele).val();
                var count = 0;
                $("img.form-img-preview[type-id='"+type_id+"']").each(function (i,v) {
                    if($(v).prop("src") != undefined && $(v).prop("src").length > 1){
                        count ++;
                    }
                })
                if(count < 1){
                    layer.msg("必须上传"+$(ele).attr("type-name")); return false;
                }
            });
            var dataItem = [];
            $("img.form-img-preview").each(function (index,ele) {
                if($(ele).prop("src") != undefined && $(ele).prop("src").length > 1){
                    dataItem.push({"type_id":$(ele).attr("type-id"),"base64data":$(ele).prop("src")});
                }
            });
            layer.confirm("确定要提交吗？",{btn:["确定","取消"]},function () {
                $("form[name='cert-form']").submit();
                // var load = layer.load();
                // $.post("/asset/create/step2",{"certItem":dataItem},function (re) {
                //     layer.close(load);
                //     if(re.status == 200){
                //         layer.confirm("提交成功！",{btn:["确定"]},function () {
                //             window.location.href = re.data.url;
                //         })
                //     }else{
                //         layer.msg(re.msg);
                //     }
                // });
            });
            return false;
       });
   });
});
//上传控件改变
function fileInputChange(object) {
    if($(object).val() != undefined && $(object).val().length > 1){
        var file;
        var img = $(object).parent().find("img.form-img-preview")[0];
        // 循环用户多选的文件
        for(var x = 0, xlen = object.files.length; x < xlen; x++) {
            file = object.files[x];
            if(file.type.indexOf('image') != -1) { // 非常简单的交验
                var reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result; // 显示图片的地方
                };
                reader.readAsDataURL(file);
            }
        }
        $(object).parent().next().find("input.btn-preview-look").prop("disabled",false);
        $(object).parent().next().find("input.btn-preview-add").prop("disabled",false);
        $(object).parent().next().find("input.btn-preview-look").removeClass("layui-btn-disabled");
        $(object).parent().next().find("input.btn-preview-add").removeClass("layui-btn-disabled");
    }else{
        $(object).parent().next().find("input.btn-preview-look").prop("disabled",true);
        $(object).parent().next().find("input.btn-preview-add").prop("disabled",true);
        $(object).parent().next().find("input.btn-preview-look").addClass("layui-btn-disabled");
        $(object).parent().next().find("input.btn-preview-add").addClass("layui-btn-disabled");
    }
}

//图片预览
function filePreview(object) {
    var src = $(object).parent().prev().find("img.form-img-preview").prop("src");
    var l = layer.open({
        "title":"预览",
        "content":"<img src='"+src+"'>",
        "scrollBar":true,
        "maxWidth":"1000",
        "maxmin":true
    });
}

function fileInputDelete(object) {
    $(object).parent().parent().remove();
}

//操作按钮
function fileInputAdd(object) {
    var c = '<div class="form-group">' +
        '<label class="col-sm-2 control-label">+</label>' +
        '<div class="col-sm-5">' +
        '<input type="file" class="form-control form-file" onchange="fileInputChange(this)">' +
        '<img class="form-img-preview" style="display: none;" type-id="'+$(object).attr("type-id")+'">'+
        '</div>'+
        '<div class="col-sm-5">' +
        '<input type="button" class="layui-btn layui-btn-disabled btn-preview-look" onclick="filePreview(this)"  value="预览"/>' +
        '<input type="button" class="layui-btn btn-preview-delete" onclick="fileInputDelete(this)" value="删除"/>' +
        '</div></div>';
    $(object).parent().parent().after(c);
}