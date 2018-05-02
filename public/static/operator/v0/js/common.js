/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/6.
 */

function loginout() {
    layui.use(["layer"],function () {
        var layer = layui.layer;
        layer.confirm("真的要退出吗？",{btn:["确定","返回"]},function () {
            $.get("/loginout",function (re) {
                if(re.status == 200){
                    window.location.href="/";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
}

