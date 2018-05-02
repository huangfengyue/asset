@extends("test.v0.layouts.default")
@section("title","发起新申请")
@section("head")
    <script src="{{asset('static/test/v0/js/asset/create.js')}}"></script>
@endsection
@section("content")

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>发起新申请</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/test">首页</a>
                </li>
                <li>
                    <a href="/test/asset">申请列表</a>
                </li>
                <li class="active">
                    <strong>发起申请</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
       <p style="background-color:yellow;font-size:40px;">什么妖魔鬼怪啊</p>
    </div>
@endsection