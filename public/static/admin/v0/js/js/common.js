//弹框异步加载新页面
function dialog_load_form(name,file_url,title){
    //$(name).click(function(){
        $.get(file_url, function(data) {
            layer.open({
                type: 1,
                area: ['480px', 'auto'],
                title: title,
                shade: 0.6,
                moveType: 1,
                shift: 1,
                content: data
            });
        })
    //})
}
function dialog_load_form1(name,file_url){
     $.get(file_url, function(data) {
            layer.open({
                type: 1,
                area: ['480px', 'auto'],
                title: '添加品牌',
                shade: 0.6,
                moveType: 1,
                shift: 1,
                content: data
            });
        })
}
//删除
function do_delete(id,url,jump_url){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: 'id='+id,
        success: function (obj) {
            if(obj.status == 1){
                layer.alert(obj.message, {
                    icon: 1,
                    shadeClose: false,
                    skin: 'layer-ext-moon',
                    btn:false,
                    area: ['259px', '166px'],
                    time: 60000
                });
                setTimeout(function(){window.location.href= jump_url;}, 1000)
            }
            else{
                layer.alert(obj.message, {
                    icon: 2,
                    shadeClose: false,
                    skin: 'layer-ext-moon', //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
					btn:false,
                    area: ['259px', '166px'],
                    time: 60000
                });
                setTimeout(function(){window.location.reload(jump_url);}, 1000)
            }
        },
        error: function(data) {
            layer.alert('网络错误', {
                icon: 0,
                shadeClose: false,
                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
            })
        }
    })
}
//异步提交
$(document).on('submit','form[data-type=ajax]', function(){
    var url = $(this).attr('action');
    var data = $(this).serializeArray();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url,
        data: data,
        success: function (obj) {
            if(obj.status == 1){
                layer.alert(obj.message, {
                    icon: 1,
                    shadeClose: false,
                    skin: 'layer-ext-moon',
                    btn:false,
                    area: ['259px', '166px']
                });
                setTimeout(function(){window.location.href= obj.info.url;}, 1000);
            }
            else{
                layer.alert(obj.message, {
                    icon: 2,
                    shadeClose: false,
                    skin: 'layer-ext-moon', //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    time: 1000,
                    btn:false,
                    area: ['259px', '166px']
                })
            }
        },
        error: function(data) {
            layer.alert('网络错误', {
                icon: 0,
                shadeClose: false,
                btn:false,
                time: 1000,
                area: ['259px', '166px'],
                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
            })
        }
    });
    return false;
});

$(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Get the name of active tab
        var activeTab = $(e.target).text();
        // Get the name of previous tab
        var previousTab = $(e.relatedTarget).text();
        $(".active-tab span").html(activeTab);
        $(".previous-tab span").html(previousTab);
    });
});

$(function () {
    //全选功能
    $('.j_all_checked .checkbox').on('click',function(){
        var checkbox_tbody=$(this).parents('.table-check').find("tbody input[type='checkbox']");
        var checkbox_all=$(this).parents('.table-check').find('.checkbox');
        if(checkbox_tbody.attr('checked')){
            checkbox_all.removeClass('cur');
            checkbox_tbody.removeAttr('checked');
        }
        else{
            checkbox_all.addClass('cur');
            checkbox_tbody.attr('checked','checked');
        }
    });
    //单选功能
    $('.table-check tbody .checkbox').on('click',function(){

        //if($(this).siblings("input[type='checkbox']").attr('checked')){
        if($(this).prev().attr('checked')){
            $(this).removeClass('cur');
            $(this).prev().removeAttr('checked');

        }
        else{
            $(this).addClass('cur');
            $(this).prev().attr('checked', 'checked');
        }
    })
    //删除功能
  /*  $('.delete').click(function() {
        $(this).parents('tr').remove();
    });*/
    // 删除会员
/*    $('.j_del_purple').click(function() {
        var checks = $('.table-check').find('input[type="checkbox"]:checked');
        //console.log(checks.length);
        for(var i = 0, l = checks.length; i < l; i++) {
            $(checks[i]).parents('tr').remove();
        }
    });*/
//全选取消
    $('body').on('click','#all',function () {
        //实现全选反选功能
        var checkbox_all =  $('table tr td input[type=checkbox]');
        if (this.checked) {
            for(var i = 0, l = checkbox_all.length; i < l; i++) {
                checkbox_all[i].checked = true;
            }
        }else {
            for(var i = 0, l = checkbox_all.length; i < l; i++) {
                checkbox_all[i].checked = false;
            }
        }
    });
//判断是否全选
    $("input[name='genre']").click(function(){
        allchk();
    });
    function allchk(){
        var chknum =$("input[name='genre']").size();//选项总个数
        var chk = 0;
        $("input[name='genre']").each(function () {
            if($(this).is(':checked')) {
                chk++;
            }
        });
        if(chknum == chk){//全选
            $("input[id='all']").prop("checked",true);
        }else{//不全选
            $("input[id='all']").prop("checked",false);
        }
    }

    // 删除品牌(全选)
    $('body').on('click','.j_del_purple',function() {
        var checks = $('table tr td').find('input[type="checkbox"]:checked');        //console.log(checks.length);
        if(checks.length <= 0){
            layer.alert("请选择要删除的数据！");
        }else{
            layer.confirm('你确定删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
            var obj = document.getElementsByName("genre");
            var check_val = [];
            for(k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            /*for(var i = 0, l = checks.length; i < l; i++) {
                $(checks[i]).parents('tr').remove();
            }*/
            var url = document.getElementById("url").value;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: url,
                data: 'ids='+check_val,
                success: function (obj) {
                    if(obj.status == 1){
                        layer.alert(obj.message, {
                            icon: 1,
							shadeClose: false,
							skin: 'layer-ext-moon',
							btn:false,
							area: ['259px', '166px']	
                        })
						setTimeout(function(){ window.location.reload();},1000);
                    }
                    else{
                        layer.alert(obj.message, {
                            icon: 2,
							shadeClose: false,
							skin: 'layer-ext-moon', //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
							time: 1000,
							btn:false,
							area: ['259px', '166px']
                        })
						setTimeout(function(){ window.location.reload();},1000);
                    }
                },
                error: function(data) {
                    layer.alert('网络错误', {
                        icon: 0,
                        shadeClose: false,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
                }
            });
            }, function(){

            });
        }

    });
});




var Browser = new Object();
Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
Browser.isIE = window.ActiveXObject ? true : false;
Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);

var imgPlus = new Image();
imgPlus.src = "assets/admin/images/menu_plus.gif";
/**
 * 折叠分类列表
 */
function rowClicked(obj,name)
{
  // 当前图像
  img = obj;
  // 取得上二级tr>td>img对象
  obj = obj.parentNode.parentNode;
  // 整个分类列表表格
  var tbl = document.getElementById(name);
  // 当前分类级别
  var lvl = parseInt(obj.className);
  // 是否找到元素
  var fnd = false;
  var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;
  // 遍历所有的分类
  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];
      if (row == obj)
      {
          // 找到当前行
          fnd = true;
          //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              var icon = 'icon_' + row.id;
              if (cur > lvl)
              {
                  row.style.display = sub_display;
                  if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                  }
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG" && imgObj.src != 'assets/admin/images/menu_arrow.gif')
      {
          imgObj.src = (imgObj.src == imgPlus.src) ? 'assets/admin/images/menu_minus.gif' : imgPlus.src;
      }
  }
}


/*点击分店的编辑*/
function pack_edit(a,b,c){
    $(a).click(function(){
        $(c).css('display','none');
        $(b).css('display','block');
    })
}

//上传头像的兼容
jQuery.extend({
    browser: function()
    {
        var
            rwebkit = /(webkit)\/([\w.]+)/,
            ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/,
            rmsie = /(msie) ([\w.]+)/,
            rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/,
            browser = {},
            ua = window.navigator.userAgent,
            browserMatch = uaMatch(ua);

        if (browserMatch.browser) {
            browser[browserMatch.browser] = true;
            browser.version = browserMatch.version;
        }
        return { browser: browser };
    },
});

function uaMatch(ua)
{
    ua = ua.toLowerCase();

    var match = rwebkit.exec(ua)
        || ropera.exec(ua)
        || rmsie.exec(ua)
        || ua.indexOf("compatible") < 0 && rmozilla.exec(ua)
        || [];

    return {
        browser : match[1] || "",
        version : match[2] || "0"
    };
}
