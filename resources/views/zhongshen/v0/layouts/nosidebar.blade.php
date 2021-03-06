<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title") | 网行B端管理系统</title>
    <script src="{{asset('static/common/v0/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('static/common/v0/js/js-extends.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/vendors/layui/css/layui.css')}}"/>
    <script type="text/javascript" src="{{asset('static/vendors/layui/layui.js')}}"></script>
    <script src="{{asset('static/common/v0/js/bank58-validator.js')}}"></script>
    <link href="{{asset('static/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/vendors/animate/animate.css')}}" rel="stylesheet">
    @yield("head")
    <link href="{{asset('static/zhongshen/v0/css/style.css')}}" rel="stylesheet">
    <script src="{{asset('static/vendors/jquery/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('static/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('static/vendors/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('static/vendors/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('static/zhongshen/v0/js/inspinia.js')}}"></script>
    <script src="{{asset('static/zhongshen/v0/js/common.js')}}"></script>
</head>
<body>
@yield('content')
</body>
</html>