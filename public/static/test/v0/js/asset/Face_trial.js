/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/8.
 */

$(function () {
    layui.use(["layer","form"],function () {
        var layer = layui.layer,
            form = layui.form();
        form.on("submit(next)",function (data) {
            $.post("/agency/asset/face_trial",data.field,function (re) {
                if(re.status == 200){
                    //  window.location.href = "/agency/asset/create/step2";
                    window.location.href = "/agency/asset/loan_category";
                }else{
                    layer.msg(re.msg);
                }
            });
        });
    });
    $("#btnSubmit").click(function(){
        for (var i = 1; i < 44; i++) {
            var val = $('input:radio[name="type'+i+'"]:checked').val();
            var val_1 = $('input:radio[name="type1"]:checked').val();
            var val_2 = $('input:radio[name="type2"]:checked').val();
            var val_3 = $('input:radio[name="type3"]:checked').val();
            var val_4 = $('input:radio[name="type4"]:checked').val();
            var val_5 = $('input:radio[name="type5"]:checked').val();
            var val_8 = $('input:radio[name="type8"]:checked').val();
            var val_19 = $('input:radio[name="type19"]:checked').val();
            var val_22 = $('input:radio[name="type22"]:checked').val();
            var val_25 = $('input:radio[name="type25"]:checked').val();
            var val_30 = $('input:radio[name="type30"]:checked').val();
            var val_31 = $('input:radio[name="type31"]:checked').val();
            var val_32 = $('input:radio[name="type32"]:checked').val();
            if(val_1 == "0"||val_2 == "0"||val_4 == "0"||val_5 == "0"||val_22 == "0"||val_23 == "0"||val_24 == "0"||val_25 == "0"||val_3 == "1"||val_8 == "1"||val_30 == "1"||val_19 == "1"||val_31 == "1"||val_32 == "1"){

                alert("很抱歉，你的面审信息不达标！");
                window.location.href = "/agency/asset";
                return false;
            }else if (val == null) {
                alert('"请填写type'+i+'"');
                return false;
            }
        }
    });
});