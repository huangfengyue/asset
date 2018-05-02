<html>
<head>
    <meta charset="utf-8">
    <title>成功跳转中…</title>
    <script src="{{asset('static/common/v0/js/jquery-3.1.1.min.js')}}"></script>
    <script>
        $(function () {
            var time = parseInt($("#time").text()) * 1000;
            var t1 = setInterval(function () {
                var ts = $("#time").text();
                if(ts <= 0){
                    clearInterval(t1);
                }else{
                    $("#time").text(ts - 1);
                }
            },1000);
            var t = setTimeout(function () {
                window.location.href = $("#return_url").prop("href");
            },time)
        });
    </script>
</head>
<body>
<h3>{{$msg or "成功!O(∩_∩)O哈哈~"}}</h3>
<h5>自动跳转中…剩余<span id="time">{{$time or 3}}</span>s，<a id="return_url" style="text-decoration: none;color: dimgrey;" href="{{$return_url}}">立即跳转</a></h5>
</body>
</html>