/**
 * Created by Jinping<jinping_125@qq.com> on 2017/3/6.
 */
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
