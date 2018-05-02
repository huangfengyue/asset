/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/13.
 */
function showPreview(cert_id) {
    layui.use(["element","layer"],function () {
        var layer = layui.layer;
        var l = layer.open({
            "title":"预览",
            "content":"<img src='" + $("span.img-uri[cert-id='"+cert_id+"']").attr("data-uri")+"'>",
            "scrollBar":true,
            "maxWidth":"800",
            "maxmin":true
        });
    });
}

//修改
function update(type_id) {
    var apply_id = $("input[name='apply_id']").val();
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.open({
            type: 2,
            title: '修改证件',
            shadeClose: true,
            shade: 0.8,
            area: ['75%', '90%'],
            content: '/agency/asset/'+apply_id+"/update/"+type_id //iframe的url
        });
    });
}