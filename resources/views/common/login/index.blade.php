<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>用户登录</title>
    <link rel="stylesheet" type="text/css" href="{{asset('static/common/v0/css/login.css')}}" />
    <script src="{{asset('static/common/v0/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('static/common/v0/js/js-extends.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/vendors/layui/css/layui.css')}}"/>
    <script type="text/javascript" src="{{asset('static/vendors/layui/layui.js')}}"></script>
    <script src="{{asset('static/common/v0/js/bank58-validator.js')}}"></script>
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
</head>
<body>
    <form class="layui-form" role="form" method="POST" action="{{url('/login')}}">
        <dl class="admin_login">
            <dt>
                <strong>网行B端管理系统</strong>
                <em>Shanghai-Wanghang</em>
            </dt>
            <dd class="user_icon">
                <input type="text" lay-verify="username" placeholder="手机号/用户名" name="username" class="login_txtbx"/>
            </dd>
            <dd class="pwd_icon">
                <input type="password" lay-verify="password" placeholder="输入密码" name="password" class="login_txtbx" />

            </dd>
            <dd>
                <input type="button" lay-submit lay-filter="submit" value="立即登陆" class="submit_btn" id="btn-login"/>
            </dd>
            <dd>
                <p><a href="{{url('/newpwd')}}">修改密码</a></p>
                <p>网行B端管理系统</p>
            </dd>
        </dl>

    </form>
    <script src="{{asset('static/vendors/Particleground.js')}}"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });
        layui.use(["form"],function () {
           var form = layui.form();
           form.verify({
               "username":function (val) {
                   if(!bank58Validator.username.test(val)){
                       return '用户名有误';
                   }
               },
               "password":function (val) {
                   if(!bank58Validator.password.test(val)){
                       return "密码输入有误";
                   }
               }
           });
           form.on("submit(submit)",function (data) {
               $.post("/login",data.field,function (re) {
                    if(re.status == 200){
                        window.location.href = "/";
                    }else{
                        layer.msg(re.msg);
                    }
               });
           });
        });
    </script>
</body>
</html>

