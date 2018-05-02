<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title") 百路汇信息管理平台</title>
    <script src="{{asset('static/common/v0/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('static/common/v0/js/js-extends.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/vendors/layui/css/layui.css')}}"/>
    <script type="text/javascript" src="{{asset('static/vendors/layui/layui.js')}}"></script>
    <script src="{{asset('static/common/v0/js/bank58-validator.js')}}"></script>
    <link href="{{asset('static/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/vendors/animate/animate.css')}}" rel="stylesheet">
    @yield("head")
    <link href="{{asset('static/financer/v0/css/style.css')}}" rel="stylesheet">
    <script src="{{asset('static/vendors/jquery/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('static/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('static/vendors/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('static/vendors/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('static/financer/v0/js/inspinia.js')}}"></script>
    <script src="{{asset('static/financer/v0/js/common.js')}}"></script>
</head>
<body>
<div id="wrapper">
    @include('admin.v0.layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    {{--<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>--}}
                    {{--<form role="search" class="navbar-form-custom" action="search_results.html">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" placeholder="搜索…" class="form-control" name="top-search" id="top-search">--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Hi,1</span>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fa fa-sign-out"></i> 退出
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('content')
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> 网行资产端综合管理系统 &copy; {{config("domain.asset")}}
            </div>
        </div>
    </div>
</div>
</body>
</html>