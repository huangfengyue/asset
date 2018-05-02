#用户相关

#用户表
CREATE table usr_user(
  user_id int(11) unsigned KEY auto_increment,
  username varchar(30) unique not null comment '用户名',
  nickname varchar(30) not null comment '昵称',
  mobile varchar(20) unique not null comment '手机号',
  email varchar(50) comment '邮箱',
  password char(32) not null comment '密码',
  role_id int(11) unsigned not null comment '角色ID',
  reg_time int(11) unsigned not null comment '注册时间',
  reg_ip varchar(100) not null comment '注册IP',
  last_time int(11) unsigned comment '上次登录时间',
  last_ip varchar(100) comment '上次登录IP',
  this_time int(11) unsigned comment '本次登录时间',
  this_ip varchar(100) comment '本次登录IP',
  `status` tinyint(3) unsigned not null DEFAULT 1 comment '状态 0禁用 1启用 99软删除'
) comment = '用户表' engine = INNODB

#角色表
CREATE TABLE usr_role(
  role_id int(11) unsigned KEY auto_increment,
  role_name varchar(30) unique not null comment '角色名',
  role_desc varchar(255) comment '角色描述',
  create_time int(11) unsigned not null comment '创建时间',
  update_time int(11) unsigned comment '更新时间',
  `status` tinyint(3) unsigned not null DEFAULT 1 comment '状态 0禁用 1启用 99软删除'
) comment = '用户角色' engine = INNODB

#权限表
CREATE TABLE usr_permission(
  pid int(11) unsigned key auto_increment,
  pname varchar(30) UNIQUE not null comment '权限名',
  route varchar(30) not null comment '路由',
  create_time int(11) unsigned not null comment '创建时间',
  update_time int(11) unsigned comment '更新时间',
  `status` tinyint(3) unsigned default 1 not null comment '状态 0禁用 1启用 99软删除'
) comment = '权限表' engine = INNODB

#角色分配权限
create table usr_role_permission(
    rp_id int(11) unsigned key auto_increment,
    role_id int(11) unsigned not null comment '角色ID',
    pid int(11) unsigned not null comment '权限ID',
    create_time int(11) unsigned not null comment '创建时间',
    status tinyint(3) unsigned not null default 1 comment '状态 0未启用 1启用'
)comment = "角色权限分配表" engine = INNODB