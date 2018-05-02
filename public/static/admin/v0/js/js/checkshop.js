function check(){
    var shop_name = document.formname.shop_name.value;//店铺名称
    var license_img = document.formname.license_img.value;//营业执照电子版
	var shop_logo = document.formname.shop_logo.value;//店铺LOGO
	var shop_descript = document.formname.shop_descript.value;//店铺描述
    var license_indate = document.formname.license_indate.value;//成立日期
    var bank_apply = document.formname.bank_apply.value;//开户许可证
    var license_num = document.formname.license_num.value;//营业执照注册号
    var corporate_name = document.formname.corporate_name.value;//法定代表人姓名
    var corporate_card_img = document.formname.corporate_card_img.value;//身份证电子版
    var contacts = document.formname.contacts.value;//联系人
    var bank_name = document.formname.bank_name.value;//开户银行
    var corporate_card = document.formname.corporate_card.value;//身份证号
    var ctel = document.formname.ctel.value;//联系电话
    var cmobile = document.formname.cmobile.value;//联系人手机
    var bankID = document.formname.bankID.value;//银行帐号
    //公司所在地必填
    var company_pro_id = document.formname.company_pro_id.value;
    var company_city_id = document.formname.company_city_id.value;
    var company_area_id = document.formname.company_city_id.value;
    var company_addr = document.formname.company_addr.value;
    //以下为营业执照所在地和开户银行所在地，如果检测到一项填了其余的则必填
    var license_pro_id = document.formname.license_pro_id.value;
    var license_city_id = document.formname.license_city_id.value;
    var license_area_id = document.formname.license_area_id.value;
    var license_addr = document.formname.license_addr.value;
    var bank_pro_id = document.formname.bank_pro_id.value;
    var bank_city_id = document.formname.bank_city_id.value;
    var bank_area_id = document.formname.bank_area_id.value;
    var bank_addr = document.formname.bank_addr.value;
	var corporate_identity = document.formname.corporate_identity.value;
	var corporate_passport = document.formname.corporate_passport.value;
	var time = document.formname.time.value;
	var shop_url = document.formname.shop_url.value;
	//资质
	//var description1_pic = document.formname.description1_pic.value;//店铺LOGO
	//var description2_pic = document.formname.description2_pic.value;//店铺LOGO
	//var description3_pic = document.formname.description3_pic.value;//店铺LOGO
    function trimStr(str){return str.replace(/(^\s*)|(\s*$)/g,"");}
 
    //if(!shop_name || !license_img || !license_indate || !bank_apply || !license_num || !license_num || !corporate_name || !corporate_card_img || !contacts || !bank_name){
    //    layer.alert("带*号的必填", {
    //        icon: 2,
    //        shadeClose: false,
    //        skin: 'layer-ext-moon',
    //        btn:false,
    //        area: ['259px', '166px'],
    //        time: 1000
    //    });
    //    return false;
    //}
	if(trimStr(shop_name) == '' || trimStr(shop_name) == 0){
		layer.alert("名称不能为空", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	if(trimStr(license_num) == ''){
		layer.alert("营业执照注册号不能为空", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	if(trimStr(license_num) == 0){
		layer.alert("请填写有效的营业执照注册号", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	//法定代表人姓名
	if(trimStr(corporate_name) == ''){
		layer.alert("法定代表人姓名不能为空", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	if(trimStr(corporate_name) == 0){
		layer.alert("请填写正确的法定代表人姓名", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	if(corporate_identity == 1 && (corporate_card_img == 0 || corporate_card_img == '')){
	    layer.alert("请上传法人身份证", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	//店铺LOGO
	if(shop_logo == 0 || shop_logo == ''){
	    layer.alert("请上传店铺LOGO", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	//店铺描述 
	if(trimStr(shop_descript) == ''){
	    layer.alert("请填写店铺描述", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(trimStr(shop_descript) == 0){
	    layer.alert("请填写有效店铺描述", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	//营业执照副本-电子版
	if(license_img == 0 || license_img == ''){
	    layer.alert("请上传营业执照副本-电子版", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(corporate_identity == 1){
		if(trimStr(corporate_card) == ''){
			layer.alert("身份证号不能为空", {
				icon: 2,
				shadeClose: false,
				skin: 'layer-ext-moon',
				btn:false,
				area: ['259px', '166px'],
				time: 1000
			});
			return false;
		}
		if(!(/(^\d{15}$)|(^\d{18}$)|(^\d{17}([0-9]|X|x)$)/.test(corporate_card))){
			layer.alert("身份证输入不合法", {
				icon: 2,
				shadeClose: false,
				skin: 'layer-ext-moon',
				btn:false,
				area: ['259px', '166px'],
				time: 1000
			});
			return false;
        }
	}
	//护照
	if(corporate_identity == 2 && trimStr(corporate_passport) == ''){
		layer.alert("非大陆居民法人护照号必填", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(corporate_identity == 2 && corporate_passport == 0){
		layer.alert("请填写有效的法人护照号", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(license_pro_id || license_city_id || license_area_id || license_addr){
        if(!license_pro_id || !license_city_id || !license_area_id || !license_addr){
            layer.alert("营业执照所在地信息请补充完整或者全部不填", {
                icon: 2,
                shadeClose: false,
                skin: 'layer-ext-moon',
                btn:false,
                area: ['259px', '166px'],
                time: 1000
            });
            return false;
        }
    }
	//营业执照有效期
	//if(trimStr(license_indate) == ''){
	//	layer.alert("请填写营业执照有效期", {
	//		icon: 2,
	//		shadeClose: false,
	//		skin: 'layer-ext-moon',
	//		btn:false,
	//		area: ['259px', '166px'],
	//		time: 1000
	//	});
	//	return false;
	//}
    license_indate = license_indate.replace(/-/g,'/'); // 将-替换成/，因为下面这个构造函数只支持/分隔的日期字符串
	//var time1 = new Date(license_indate).getTime();
	//var nowDate = new Date().getTime();
    if(new Date(license_indate).getTime() < new Date().getTime()){
		layer.alert("营业执照已过期", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
    if(!company_pro_id || !company_city_id || !company_area_id){
        layer.alert("所在地必填", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
    }
	if(trimStr(company_addr) == ''){
		layer.alert("请填写所在地详细地址", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
	}
	//联系电话
	if(trimStr(ctel) == ''){
		layer.alert("请填写联系电话", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	//电话正则表达式：/(^\d{3}-\d{8}|\d{4}-\d{7}$)/
	//if(!(/^(0\\d{2}-\\d{8}(-\\d{1,4})?)|(0\\d{3}-\\d{7,8}(-\\d{1,4})?)|^400[0-9]{7}|^800[0-9]{7}$/.test(ctel))){
		if(!(/^0\d{2,3}-?\d{7,8}|^400[0-9]{7}|^800[0-9]{7}|^1[34578]\d{9}$/.test(ctel))){
		//if(!(/^(0\\d{2}-\\d{8}(-\\d{1,4})?)|(0\\d{3}-\\d{7,8}(-\\d{1,4})?)|^400[0-9]{7}|^800[0-9]{7}$/.test(ctel))){
        layer.alert("电话号码格式输入有误", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
    }
	//联系人
	if(trimStr(contacts) == ''){
		layer.alert("请填写联系人", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(trimStr(contacts) == 0){
		layer.alert("请填写有效联系人", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	//联系人手机号
	if(trimStr(cmobile) == ''){
		layer.alert("请填写联系人手机号", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(!(/^1[34578]\d{9}$/.test(cmobile))){
        layer.alert("手机号码格式有误，请重填", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
    }
	//开户银行 
	if(trimStr(bank_name) == ''){
		layer.alert("请填写开户银行", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
    if(trimStr(bank_name) == 0){
		layer.alert("请填写有效开户银行", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
    //银行账号
    if(trimStr(bankID) == ''){
		layer.alert("请填写银行账号", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(!(/(^\d{1,21}$)/.test(bankID))){
        layer.alert("银行卡号输入有误", {
            icon: 2,
            shadeClose: false,
            skin: 'layer-ext-moon',
            btn:false,
            area: ['259px', '166px'],
            time: 1000
        });
        return false;
    }
    if(bank_pro_id || bank_city_id || bank_area_id || (trimStr(bank_addr) != '' && trimStr(bank_addr) != 0)){
        if(!bank_pro_id || !bank_city_id || !bank_area_id || trimStr(bank_addr) == '' || trimStr(bank_addr) == 0){
            layer.alert("开户银行所在地信息请补充完整或者全部不填", {
                icon: 2,
                shadeClose: false,
                skin: 'layer-ext-moon',
                btn:false,
                area: ['259px', '166px'],
                time: 1000
            });
            return false;
        }
    }
    //开户许可证
	if(trimStr(bank_apply) == ''){
		layer.alert("请填写开户许可证", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}
	if(trimStr(bank_apply) == 0){
		layer.alert("请填写有效开户许可证", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}

	if(trimStr(time) == 0 || time == '-'){
		layer.alert("请填写营业时间", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}

	if(!shop_url){
		layer.alert("请输入链接", {
			icon: 2,
			shadeClose: false,
			skin: 'layer-ext-moon',
			btn:false,
			area: ['259px', '166px'],
			time: 1000
		});
		return false;
	}else{
		if(shop_url.indexOf("http://")<0){
			layer.alert("请输入正确的链接", {
				icon: 2,
				shadeClose: false,
				skin: 'layer-ext-moon',
				btn:false,
				area: ['259px', '166px'],
				time: 1000
			});
			return false;
		}

	}

	//店铺LOGO
	//if(description1_pic == 0 || description1_pic == ''){
	//	layer.alert("请上传店铺简介", {
	//		icon: 2,
	//		shadeClose: false,
	//		skin: 'layer-ext-moon',
	//		btn:false,
	//		area: ['259px', '166px'],
	//		time: 1000
	//	});
	//	return false;
	//}

	//店铺LOGO
	//if(description2_pic == 0 || description2_pic == ''){
	//	layer.alert("请上传店铺资质", {
	//		icon: 2,
	//		shadeClose: false,
	//		skin: 'layer-ext-moon',
	//		btn:false,
	//		area: ['259px', '166px'],
	//		time: 1000
	//	});
	//	return false;
	//}

	//店铺LOGO
	//if(description3_pic == 0 || description3_pic == ''){
	//	layer.alert("请上传店铺推荐", {
	//		icon: 2,
	//		shadeClose: false,
	//		skin: 'layer-ext-moon',
	//		btn:false,
	//		area: ['259px', '166px'],
	//		time: 1000
	//	});
	//	return false;
	//}
}
//图片上传
function submitFour(id){
    var data = new FormData($('#Form-1')[0]);
    $.ajax({
        url: '?app=backend&act=upload&img_id='+id,
        type: 'POST',
        data: data,
        dataType: 'JSON',
        cache: false,
        processData: false,
        contentType: false
    }).done(function(ret){
        if(ret['status'] == 1){
            var image_id =ret.info.image_id;
            $("#"+id).next('input').val(image_id);
        }else{
            layer.alert("图片上传失败", {
                icon: 2,
                shadeClose: false,
                skin: 'layer-ext-moon',
                btn:false,
                area: ['259px', '166px'],
                time: 1000
            });
            return false;
        }
    });
    return false;
}


//获取当前市区列表
function getcitylist(id){
    var pro_id = $.trim($("#"+id).val());
    $.ajax({
        url: '?app=backend&act=getcitylist',
        type: 'POST',
        data: "pro_id="+pro_id,
        dataType: "json",
        success:function(msg) {
            var html = "<option value=''>请选择</option>";
            $.each(msg, function(key, value){

                html += "<option value='"+value.id+"'>"+value.name+"</option>";

            });
            $("#"+id).next('select').html(html);

        }
    });
    return false;
}

//获取当前区域列表
function getarealist(id){
    var city_id = $.trim($("#"+id).val());
    $.ajax({
        url: '?app=backend&act=getarealist',
        type: 'POST',
        data: "city_id="+city_id,
        dataType: "json",
        success:function(msg) {
            var html = "<option value=''>请选择</option>";
            $.each(msg, function(key, value){

                html += "<option value='"+value.id+"'>"+value.name+"</option>";

            });
            $("#"+id).next('select').html(html);

        }
    });
    return false;
}