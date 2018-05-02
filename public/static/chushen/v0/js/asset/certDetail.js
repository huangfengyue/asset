/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/13.
 */
//预览
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