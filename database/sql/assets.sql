#资产相关

#资产申请表
CREATE TABLE ast_apply(
  apply_id int(11) unsigned KEY auto_increment,
  apply_no varchar(20) unique not null comment '流水号',
  user_id int(11) unsigned not null comment '申请人用户ID',
  applier_mobile varchar(20) not null comment '借款人手机号',
  applier_idcard varchar(20) not null comment '借款人身份证号',
  apply_amt decimal(11,2) unsigned not null comment '申请额度',
  deadline int(11) unsigned not null comment '借款期限',
  deadline_type tinyint(3) unsigned not null default 1 comment '期限单位类型，1天 2月',
  bankcard_no varchar(30) not null comment '银行卡号',
  bankcard_type varchar(30) not null comment '所属银行',
  repay_type int(11) unsigned not null comment '还款方式',
  clerk_name varchar(30) not null comment '业务员名称',
  applier_remark varchar(1024) comment '借款人备注',
  asset_remark varchar(1024) comment '资产部备注',
  ck1_asset_id int(11) unsigned comment '一审资产管理员ID',
  ck2_asset_id int(11) unsigned comment '二审资产管理员ID',
  risk_ctl_remark varchar(1024) comment '风控部备注',
  ck1_risk_ctl_id int(11) unsigned comment '一审风控管理员ID',
  ck2_risk_ctl_id int(11) unsigned comment '二审风控管理员ID',
  operator_id int(11) unsigned comment '运营ID',
  create_time int(11) unsigned not null comment '创建时间',
  update_time int(11) unsigned comment '更新时间',
  `status` tinyint(3) unsigned not null default 1 comment '状态 0申请人取消 1正在等待资产一审 2等待风控一审 3一审通过等待补全视频资料 4等待资产二审 5等待风控二审 6等待运营发标 7已发标 8已满标 9资产一审拒绝 10风控一审拒绝 11资产二审拒绝 12风控二审拒绝 99软删除'
) comment = '资产资源申请表' engine = INNODB

#资产日志
CREATE TABLE ast_log(
  log_id int(11) unsigned KEY auto_increment,
  apply_id int(11) unsigned not null comment '资源申请表ID',
  log_type int(11) unsigned not null comment '日志类型 1资产一审 2风控一审 3资产二审 4风控二审',
  user_id int(11) unsigned not null comment '操作人ID',
  result tinyint(3) unsigned not null comment '操作状态结果：1成功 0拒绝或失败',
  remark varchar(1024) comment '用户备注信息',
  create_time int(11) unsigned not null comment '创建时间'
)comment = '资产变动日志' engine = INNODB

#资产申请证件类型表
create table ast_cert_type(
    type_id int(11) unsigned key auto_increment,
    type_name varchar(30) unique not null comment '证件名称',
    type_desc varchar(255) comment '描述',
    require tinyint(1) unsigned not null default 1 comment '必须 1是 0非',

    preview varchar(1024) comment '预览图像',
    create_time int(11) unsigned not null comment '创建时间',
    status tinyint(3) unsigned not null default 1 comment '状态 0未启用 1启用 99软删除'
)comment = '证件类型' engine = INNODB

#资产申请上传证件表
create table ast_apply_cert(
    cert_id int(11) unsigned key auto_increment,
    apply_id int(11) unsigned not null comment '资产申请记录ID',
    type_id int(11) unsigned not null comment '证件类型ID',
    item varchar(1024) not null comment '文件名，保存key值',
    create_time int(11) unsigned not null comment '创建时间',
    status tinyint(3) unsigned not null default 1 comment '状态 1有效 99软删除'
)comment = '资产申请证件表' engine = INNODB
