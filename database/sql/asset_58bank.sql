/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : asset_58bank

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-03-20 15:34:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ast_apply
-- ----------------------------
DROP TABLE IF EXISTS `ast_apply`;
CREATE TABLE `ast_apply` (
  `apply_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apply_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '流水号',
  `user_id` int(11) unsigned NOT NULL COMMENT '申请人用户ID',
  `applier_mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '借款人手机号',
  `applier_idcard` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '借款人身份证号',
  `apply_amt` decimal(11,2) unsigned NOT NULL COMMENT '申请额度',
  `deadline` int(11) unsigned NOT NULL COMMENT '借款期限',
  `deadline_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '期限单位类型，1天 2月',
  `bankcard_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '银行卡号',
  `bankcard_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '所属银行',
  `repay_type` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '还款方式 1等本等息',
  `clerk_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '业务员名称',
  `applier_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '借款人备注',
  `ck1_asset_id` int(11) unsigned DEFAULT NULL COMMENT '一审资产管理员ID',
  `ck2_asset_id` int(11) unsigned DEFAULT NULL COMMENT '二审资产管理员ID',
  `asset_ck1_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '资产部备注',
  `asset_ck2_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `riskctl_ck1_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '风控部备注',
  `riskctl_ck2_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ck1_riskctl_id` int(11) unsigned DEFAULT NULL COMMENT '一审风控管理员ID',
  `ck2_riskctl_id` int(11) unsigned DEFAULT NULL COMMENT '二审风控管理员ID',
  `ck1_pass_time` int(11) unsigned DEFAULT NULL COMMENT '一审通过时间',
  `ck2_pass_time` int(11) unsigned DEFAULT NULL COMMENT '二审通过时间',
  `ck2_submit_time` int(11) unsigned DEFAULT NULL COMMENT '二审提交时间',
  `video_auth` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频认证',
  `operator_id` int(11) unsigned DEFAULT NULL COMMENT '运营ID',
  `operator_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '运营备注',
  `publish_time` int(11) unsigned DEFAULT NULL COMMENT '发标时间',
  `full_time` int(11) unsigned DEFAULT NULL COMMENT '满标时间',
  `finish_loan_time` int(11) unsigned DEFAULT NULL COMMENT '放款时间',
  `financer_id` int(11) unsigned DEFAULT NULL COMMENT '财务ID',
  `financer_remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '财务备注',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0申请人取消 1正在等待资产一审 2等待风控一审 3一审通过等待补全视频资料 4等待资产二审 5等待风控二审 6等待运营发标 7已发标 8已满标 9资产一审拒绝 10风控一审拒绝 11资产二审拒绝 12风控二审拒绝 13已放款/待还款 14已还款/完成 99软删除',
  PRIMARY KEY (`apply_id`),
  UNIQUE KEY `apply_no` (`apply_no`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='资产资源申请表';

-- ----------------------------
-- Records of ast_apply
-- ----------------------------
INSERT INTO `ast_apply` VALUES ('13', '1703172325906', '2', '13478969874', '310107198905023687', '250.00', '250', '1', '600000869744821454', '罗醇银行', '1', '罗醇下水道', '罗醇ugly', '3', '3', '罗春  罗玉春  罗玉凤的弟弟 很牛逼 必须要贷', '我同意，请多灌水泥', '水泥醇！！！！就是我，我要灌水泥', '水泥不管管水啊', '4', '4', '1489741077', '1489742807', '1489741231', 'video/2017-03-17/d8f6deb8060f50acfdc451292b6bee39.mp4', '6', '来啊，发标啊，反正有打吧时光', '1489742887', '1489742974', '1489743011', '5', '第三方', '1489740927', '1489742807', '13');
INSERT INTO `ast_apply` VALUES ('14', '1703172378723', '2', '15999996635', '622195186503021156', '100000.00', '30', '1', '6555321226545856521', '民生银行', '1', 'i99987', '斯。。。斯国一', '3', null, '他诺系~~~~', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489743492', '1489743670', '9');
INSERT INTO `ast_apply` VALUES ('15', '1703172131777', '2', '15699654585', '370023188501053321', '50000.00', '250', '1', '456798465134565458', '广发银行', '1', 'i999945', '去了 ……', '3', '3', '丢了', '啊~~~~~~~~', '丢完了？', null, '4', null, '1489743958', null, '1489744087', 'video/2017-03-17/bc496eb69461edac17379636644c1988.mp4', null, null, null, null, null, null, null, '1489743898', '1489744229', '11');
INSERT INTO `ast_apply` VALUES ('16', '1703172626464', '2', '15966665245', '371220199506051125', '90000.00', '6', '2', '1232654585654512', '上海银行', '1', 'o999884', '夹竹桃天下第一', '3', null, '你说第一，谁是第二，难道是佳琦！！！！', null, '一般一般世界第三', null, '4', null, null, null, null, null, null, null, null, null, null, null, null, '1489744414', '1489744503', '10');
INSERT INTO `ast_apply` VALUES ('17', '1703172218927', '2', '15999652365', '371223199706052231', '80000.00', '10', '1', '213469461216456145', '中信银行', '1', 'p000595', '哈哈哈', '3', '3', '哇哇哇', '哦也', '呱呱呱', '滚蛋', '4', '4', '1489744771', null, '1489744812', 'video/2017-03-17/c120e7ceb26b61c856779061dbfffcfc.mp4', null, null, null, null, null, null, null, '1489744679', '1489745145', '12');
INSERT INTO `ast_apply` VALUES ('18', '1703172987310', '2', '15214598745', '310108199406061654', '12244.00', '24', '2', '62274654165847616', '中国银行', '1', 'a012', '发的发生大发生大发大发', '3', null, '大是的发送到', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489748989', '1489749030', '2');
INSERT INTO `ast_apply` VALUES ('19', '1703172354965', '2', '18214654599', '310108199201012654', '6500.00', '3', '2', '6227454584654445', '中国银行', '1', 'a001', '防守打法大放送大', '3', null, '欧雅茜', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489750446', '1489750780', '2');
INSERT INTO `ast_apply` VALUES ('20', '1703172856134', '2', '15214658745', '310108199210046458', '12313.00', '6', '1', '6227454654658565', '中国银行', '1', '001', '款进口了健康架框架看借款两节课了借口借口了借口了借口即可连接健康了健康了健康了健康了健康了健康了健康了即可连接健康了健康了健康了健康了健康了健康健康尽快尽快尽快尽快尽快尽快拉近距离健康了健康了健康及昆仑决克隆空间健康了健康了健康及', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489751209', null, '1');
INSERT INTO `ast_apply` VALUES ('21', '1703172869729', '2', '15214645525', '310123199603011234', '10500.00', '12', '2', '6227514321556546', '中国银行', '1', '002', '发大水发的是飞洒地方撒旦风控审单金风科技玩卡的及风控王嘉尔开服就肯定就是发附件为区分基督教风控审单积分看电视剧啊放假独守空房地方纪委区分借款圣诞节疯狂圣诞节疯狂圣诞节副科级的萨芬的九分裤大家疯狂圣诞节疯狂圣诞节疯狂及第三方绝对是看风景福建省考虑对方即可来得及风控审单积分看电视剧啊飞机的咖啡机撒放贷房间打开撒费借款大数据风控第三发送到费', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489751696', null, '1');
INSERT INTO `ast_apply` VALUES ('22', '1703172224475', '2', '18265247896', '310102199601025897', '62555.00', '52', '2', '6227454654687842', '中国银行', '1', '003', '大放送大福建省大飞机上科大解放大师傅的卡夫卡快递费监考老师大家啊风控借款大数据风控士大夫开始打几分开始打几分的分开打几分看得见啊看风景的咖啡机打飞机卡德加放款点击爱疯狂大吉费', '3', '3', '资产一审通过', '法法师的', '法师打发', '发生大大声的', '4', '4', '1489994115', '1489994182', '1489994149', 'video/2017-03-20/3a4c95602673a58e6901a1c32450ef52.mp4', '6', '饭打发点', '1489994697', '1489994856', null, null, null, '1489752028', '1489994182', '8');
INSERT INTO `ast_apply` VALUES ('23', '1703172669833', '2', '18216587895', '310108199210064598', '12257.00', '2', '2', '62278484654659886', '中国银行', '1', '004', null, '3', null, '资产一审拒绝', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489752122', '1489973600', '9');
INSERT INTO `ast_apply` VALUES ('24', '1703172182122', '2', '15214345525', '310108199212016879', '62557.00', '5', '2', '62274654687541564', '中的银行', '1', '005', null, '3', '3', '资产1审\n资产2审', '大放送大', '退回修改\n2.退回修改', '法大大是否\n2.发达发送到', '4', '4', '1489974717', '1489975495', '1489975384', 'video/2017-03-20/8fcd6f3d0739c5469d8c103e9f1b3128.mp4', '6', '答复', '1489975574', '1489975599', '1489975652', '5', '飞士大夫', '1489752201', '1489975495', '13');

-- ----------------------------
-- Table structure for ast_apply_cert
-- ----------------------------
DROP TABLE IF EXISTS `ast_apply_cert`;
CREATE TABLE `ast_apply_cert` (
  `cert_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apply_id` int(11) unsigned NOT NULL COMMENT '资产申请记录ID',
  `uri` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件名，保存key值',
  `type_id` int(11) unsigned NOT NULL COMMENT '证件类型',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1有效 99软删除',
  PRIMARY KEY (`cert_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='资产申请证件表';

-- ----------------------------
-- Records of ast_apply_cert
-- ----------------------------
INSERT INTO `ast_apply_cert` VALUES ('73', '13', 'images/2017-03-17/ef3372514038443c2ec875678e1d1867.jpeg', '1', '1489740924', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('74', '13', 'images/2017-03-17/f2ac3c7f6e731901fe37e714f81467b6.jpeg', '2', '1489740924', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('75', '13', 'images/2017-03-17/61cd85f80f1643f891c2a06b67148837.jpeg', '3', '1489740925', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('76', '13', 'images/2017-03-17/895fbcca68512f3977c7bbc38535acc6.jpeg', '4', '1489740925', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('77', '13', 'images/2017-03-17/45b37d48bc14a17d4105cd4d33b9436c.jpeg', '5', '1489740925', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('78', '13', 'images/2017-03-17/908d5258243dcdb93e21b54e77194a24.jpeg', '6', '1489740925', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('79', '13', 'images/2017-03-17/db1626c9eca68e2efc4a68d4c7af8eb1.jpeg', '7', '1489740925', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('80', '13', 'images/2017-03-17/c0b37af4fe464da74ce1ed9545724538.jpeg', '8', '1489740926', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('81', '13', 'images/2017-03-17/e3a4cc4cfcd77a5b7c00a11e78de6326.jpeg', '9', '1489740926', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('82', '13', 'images/2017-03-17/9e891bdfc9b2f3dc4ddca342551f5bab.jpeg', '10', '1489740926', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('83', '13', 'images/2017-03-17/2dd2906db51eb18c33284edcd7bb775d.jpeg', '11', '1489740926', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('84', '13', 'images/2017-03-17/551b5a1a521fbe8f275524d3d9b1988e.jpeg', '12', '1489740927', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('85', '14', 'images/2017-03-17/fd59927bbad165a5f3402443fd002ce6.png', '1', '1489743490', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('86', '14', 'images/2017-03-17/30ed685eaf121a7baa199265427d0b84.png', '2', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('87', '14', 'images/2017-03-17/97e8e3db75d92f3c398efd4ac17ff876.png', '3', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('88', '14', 'images/2017-03-17/9f403d1080264030a7212236cc85d5e7.png', '4', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('89', '14', 'images/2017-03-17/4e6fb7ff358d2aa375091ac9a6e947a2.png', '5', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('90', '14', 'images/2017-03-17/3f771cd8ae8b8921b3ebfe56cb10c9a2.png', '6', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('91', '14', 'images/2017-03-17/cc46eb5b119549506d4e63d780cb6079.png', '7', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('92', '14', 'images/2017-03-17/232b04f4dadd70a8cf18467a8ab50a8f.png', '8', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('93', '14', 'images/2017-03-17/a967991d776a5b35e420ddc7038f7f39.png', '9', '1489743491', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('94', '14', 'images/2017-03-17/a5c18217560775d9fcd89353d6cc33aa.png', '10', '1489743492', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('95', '15', 'images/2017-03-17/390cfef91cf3f87271157761e4982f94.png', '1', '1489743897', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('96', '15', 'images/2017-03-17/a9f9df0c753fd2480af0d6a7fb6db847.png', '2', '1489743897', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('97', '15', 'images/2017-03-17/28afb6c5da2942746de36b91d70c9a05.png', '3', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('98', '15', 'images/2017-03-17/fa2719ab067d73f52aa96cf804cffc87.png', '4', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('99', '15', 'images/2017-03-17/07f4bdea3cf2cb8ec426daf05efa085c.png', '5', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('100', '15', 'images/2017-03-17/7189ef63498a53a22d28593364781bec.png', '6', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('101', '15', 'images/2017-03-17/72f820164b09681dd7bddbdd33a5a0c6.png', '7', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('102', '15', 'images/2017-03-17/ec804073a496ef641768f0f0c6e0f15b.png', '8', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('103', '15', 'images/2017-03-17/afb287ef2b3bb4512a2a023c32a91a10.png', '9', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('104', '15', 'images/2017-03-17/cd8bf962ec7bd0903696e01898037ab8.png', '10', '1489743898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('105', '16', 'images/2017-03-17/74e416e5813701e222416237b8d39fad.png', '1', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('106', '16', 'images/2017-03-17/ca3abaf1997b73ee1375a0963d82ec28.png', '2', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('107', '16', 'images/2017-03-17/30f3e1ebfac1dd3f8b04993f48c31564.png', '3', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('108', '16', 'images/2017-03-17/d574c5478f8e88fb984f7033c7ea43d4.png', '4', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('109', '16', 'images/2017-03-17/e2e0b332d466cc441f850deefd279288.png', '5', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('110', '16', 'images/2017-03-17/aabe3ef47f8cab779c26abd88d90b287.png', '6', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('111', '16', 'images/2017-03-17/f5affb826c8279c269dbae423af65f7f.png', '7', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('112', '16', 'images/2017-03-17/585ee245e4bc079710e4f280bc1aa91d.png', '8', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('113', '16', 'images/2017-03-17/44a23e74e718742d026965ed0141478b.png', '9', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('114', '16', 'images/2017-03-17/82a7d1335bf200019d5393655ea72281.png', '10', '1489744414', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('115', '17', 'images/2017-03-17/e62b3b2142c4746dfef78e92e2810d63.png', '1', '1489744678', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('116', '17', 'images/2017-03-17/5ab5d9f8786d99c70544d41254b8e9ba.png', '2', '1489744678', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('117', '17', 'images/2017-03-17/0e14e109109139105a54d49fc578a1e1.png', '3', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('118', '17', 'images/2017-03-17/f2f5dfc4edd1c6e95e5771cf10483596.png', '4', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('119', '17', 'images/2017-03-17/073f0fb2e4003619b4e8cf8fcfa15671.png', '5', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('120', '17', 'images/2017-03-17/068c8709df397edbbb9d1b906cf920f0.png', '6', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('121', '17', 'images/2017-03-17/6bcb87ca80d8615fd874b5b771cafec0.jpeg', '7', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('122', '17', 'images/2017-03-17/23b8aa69b4976cee5dcb694b18bc253c.jpeg', '8', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('123', '17', 'images/2017-03-17/1639895d3e74da8132ab08771a1c3543.png', '9', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('124', '17', 'images/2017-03-17/7f238ca200a4adf300171b24337409e7.png', '10', '1489744679', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('125', '18', 'images/2017-03-17/901d54238a974c6aa9cf22517657842e.jpeg', '1', '1489748988', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('126', '18', 'images/2017-03-17/2353df79a6f70b2cd7400829cd2cc39c.jpeg', '2', '1489748988', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('127', '18', 'images/2017-03-17/2d0d2f2ad9480ceb8bda49be3d07e467.png', '3', '1489748988', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('128', '18', 'images/2017-03-17/472c295675fe17ef0be84e6460c6811c.png', '4', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('129', '18', 'images/2017-03-17/c9f3e0f25dcd30bfc0696c31c00d0dca.png', '5', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('130', '18', 'images/2017-03-17/44b0bc33e9a4e69b528a44048ceb1cd9.png', '6', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('131', '18', 'images/2017-03-17/c5cf91926a8a4c38d9a53a1ee0fe7b43.png', '7', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('132', '18', 'images/2017-03-17/baf3a2b915715439ddc67f042d12537d.png', '8', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('133', '18', 'images/2017-03-17/eb4dd67eff8a5de65ade01ccb0c8c72e.png', '9', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('134', '18', 'images/2017-03-17/483a80069d7987f39785c37352dcb855.png', '10', '1489748989', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('135', '19', 'images/2017-03-17/740c181558dd58e2126079d20aecf69b.jpeg', '1', '1489750445', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('136', '19', 'images/2017-03-17/7a6c1805e8113a2f34e64ea223732897.jpeg', '2', '1489750445', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('137', '19', 'images/2017-03-17/ba474ef9760c331afbf5587d38aaf375.jpeg', '3', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('138', '19', 'images/2017-03-17/b50350186a44af9caf971e6dcfa1157e.png', '4', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('139', '19', 'images/2017-03-17/9137accec8f9855697989d0b81a39609.png', '5', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('140', '19', 'images/2017-03-17/b26379d95087d2c31d416dbf457d33a8.png', '6', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('141', '19', 'images/2017-03-17/60d11d51f85000551c31b9c0e5104673.png', '7', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('142', '19', 'images/2017-03-17/37af710e9514b0c5e6746b21dea332ea.png', '8', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('143', '19', 'images/2017-03-17/35dfcda595bded171f14e4a84d1ea3e2.png', '9', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('144', '19', 'images/2017-03-17/9c3b61c9c0229b26d9b6db4ecaa11da1.png', '10', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('145', '19', 'images/2017-03-17/20a83d3824bfc383f9942b1e5cc9343e.png', '11', '1489750446', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('146', '20', 'images/2017-03-17/473d24833498da4ce50911f0295baba8.jpeg', '1', '1489751208', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('147', '20', 'images/2017-03-17/285c04e7f20a21db826cad13dee16282.png', '2', '1489751208', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('148', '20', 'images/2017-03-17/465f71c3390ac38611b352c322e5d0da.png', '3', '1489751208', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('149', '20', 'images/2017-03-17/63e866e796c48e9703ecdf07aa461e10.png', '4', '1489751208', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('150', '20', 'images/2017-03-17/0243cc46d114e075065ae8a8b6325b51.png', '5', '1489751208', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('151', '20', 'images/2017-03-17/c90d97cd19db64de721898002acca190.jpeg', '6', '1489751209', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('152', '20', 'images/2017-03-17/f2ec6a6b90215b94be9d45882c646794.png', '7', '1489751209', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('153', '20', 'images/2017-03-17/08d9fbccadec7847ea55d1c29c3b28a2.png', '8', '1489751209', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('154', '20', 'images/2017-03-17/91ae3da8fec0aa8d7b80acc20fab712b.png', '9', '1489751209', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('155', '20', 'images/2017-03-17/80954709bfe0f3d1bbed9ce33cc83a57.png', '10', '1489751209', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('156', '21', 'images/2017-03-17/f581665874587bcc67bdf2fd74567094.png', '1', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('157', '21', 'images/2017-03-17/583d1fe146ee275685c36151c11827a0.png', '2', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('158', '21', 'images/2017-03-17/c5fc22cce3454580514c584b5add93ff.jpeg', '3', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('159', '21', 'images/2017-03-17/29533232422b2cf8838e6375969b0dbd.png', '4', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('160', '21', 'images/2017-03-17/4f88418a16c06e62f211dd6e896a462e.png', '5', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('161', '21', 'images/2017-03-17/5429ab0094ec4feafa24b088a02afb5d.png', '6', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('162', '21', 'images/2017-03-17/a2b35acf72d39ee3b840365155586eb9.png', '7', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('163', '21', 'images/2017-03-17/e95ff84beda725f5e475b6a922f88500.png', '8', '1489751695', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('164', '21', 'images/2017-03-17/fd1af4497fb073fa6c69853f30f50996.png', '9', '1489751696', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('165', '21', 'images/2017-03-17/00ae58dfb9e6d046112e1f3ee653bdde.png', '10', '1489751696', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('166', '22', 'images/2017-03-17/81aa331f47d63df2efa6ad945b83517e.jpeg', '1', '1489752027', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('167', '22', 'images/2017-03-17/b95e5282fae84749b77c0da35b29ef1d.png', '2', '1489752027', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('168', '22', 'images/2017-03-17/f9343780a009038c5a0df7701f55d401.png', '3', '1489752027', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('169', '22', 'images/2017-03-17/c400ccc8ffb8ea78f1284a43cd8cc79c.png', '4', '1489752027', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('170', '22', 'images/2017-03-17/71978e8d13ee1e14a4878fbcb5be9406.png', '5', '1489752027', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('171', '22', 'images/2017-03-17/3dd899a502acc9522f7ad2d8e1aecee6.png', '6', '1489752028', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('172', '22', 'images/2017-03-17/ff923acc536de473e03dfe7790f95ce1.png', '7', '1489752028', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('173', '22', 'images/2017-03-17/9124fa43b5d899810efcccf40fe2c267.png', '8', '1489752028', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('174', '22', 'images/2017-03-17/dee3306a892ef7e17353189be5e4f984.png', '9', '1489752028', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('175', '22', 'images/2017-03-17/7dea91d680a3f4dd107726ecdc6dd358.png', '10', '1489752028', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('176', '23', 'images/2017-03-17/aa116b0ab71c1f2c2e848c2822323c65.jpeg', '1', '1489752121', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('177', '23', 'images/2017-03-17/e2f79116442422224f59c1a65a213973.png', '2', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('178', '23', 'images/2017-03-17/fca72ca40959e51d35c113596c11729a.jpeg', '3', '1489752122', '1489752254', '99');
INSERT INTO `ast_apply_cert` VALUES ('179', '23', 'images/2017-03-17/2bb042371daf39473b27ef8264503dbc.png', '4', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('180', '23', 'images/2017-03-17/4e9e5b1bcb1759a0d4cc90864a4255a6.png', '5', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('181', '23', 'images/2017-03-17/53097bb87b6a6e15cd4449aa6e03a9b6.png', '6', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('182', '23', 'images/2017-03-17/123dd89e1f22070fd00352b4cf1b24eb.png', '7', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('183', '23', 'images/2017-03-17/80d8b2c4c1e6e2e0d3ff21a4939ac68d.png', '8', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('184', '23', 'images/2017-03-17/4c8bf1de1f88872fc06fecde37b5077d.png', '9', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('185', '23', 'images/2017-03-17/1a9bf152d41e99de6856b7ffadbfee56.png', '10', '1489752122', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('186', '24', 'images/2017-03-17/de345494b5c5e25b57ca643f135ecc59.jpeg', '1', '1489752201', '1489973839', '99');
INSERT INTO `ast_apply_cert` VALUES ('187', '24', 'images/2017-03-17/49393a06340669872a66bd5e44f23d57.png', '2', '1489752201', '1489973898', '99');
INSERT INTO `ast_apply_cert` VALUES ('188', '24', 'images/2017-03-17/914643512d16f5158f7c05c74be7df12.png', '3', '1489752201', '1489974480', '99');
INSERT INTO `ast_apply_cert` VALUES ('189', '24', 'images/2017-03-17/62efdfabe7635bf0703e14e3da35b513.png', '4', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('190', '24', 'images/2017-03-17/12308c289b837afb3fc26055e2af4b8e.png', '5', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('191', '24', 'images/2017-03-17/e1d646b3cd1c4d2108ed4f949dbf30ad.png', '6', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('192', '24', 'images/2017-03-17/ec376af06aee1c126d6523e4f9877312.png', '7', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('193', '24', 'images/2017-03-17/04180bdf302f605b0bee5790d7a02090.png', '8', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('194', '24', 'images/2017-03-17/edf1dfc916da03c417f37fc01c4ae838.png', '9', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('195', '24', 'images/2017-03-17/1f08706868ddd06a51b828c17ccff2a7.png', '10', '1489752201', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('196', '23', 'images/2017-03-17/410255387db94af9ea73c79c132658f7.png', '3', '1489752254', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('197', '24', 'images/2017-03-20/35af62a1600300fd58bb2a014bc1023f.png', '1', '1489973782', '1489973839', '99');
INSERT INTO `ast_apply_cert` VALUES ('198', '24', 'images/2017-03-20/696e59ad86ca0710d970487dbea5f3d9.png', '1', '1489973839', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('199', '24', 'images/2017-03-20/6a18fc70fff70372ca0343695f71c3cd.png', '2', '1489973898', null, '1');
INSERT INTO `ast_apply_cert` VALUES ('200', '24', 'images/2017-03-20/c27c40fd8bf6b6046c4f2dd1a7e098b1.png', '3', '1489974480', null, '1');

-- ----------------------------
-- Table structure for ast_cert_type
-- ----------------------------
DROP TABLE IF EXISTS `ast_cert_type`;
CREATE TABLE `ast_cert_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '证件名称',
  `type_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `require` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '必须 1是 0非必须',
  `preview` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '预览图像',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0未启用 1启用 99软删除',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='证件类型';

-- ----------------------------
-- Records of ast_cert_type
-- ----------------------------
INSERT INTO `ast_cert_type` VALUES ('1', '身份证正面', '身份证正面照', '1', null, '123456', '1');
INSERT INTO `ast_cert_type` VALUES ('2', '身份证反面', '身份证反面', '1', null, '123456', '1');
INSERT INTO `ast_cert_type` VALUES ('3', '婚姻证明', '婚姻证明照', '1', null, '123456', '1');
INSERT INTO `ast_cert_type` VALUES ('4', '户口本', '户口本', '1', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('5', '公务员证明', '公务员证明', '1', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('6', '收入证明', '收入证明', '1', null, '123456', '1');
INSERT INTO `ast_cert_type` VALUES ('7', '银行流水', '银行流水', '1', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('8', '公积金证明', '公积金证明', '1', null, '123456', '1');
INSERT INTO `ast_cert_type` VALUES ('9', '个人征信报告', '个人征信报告', '1', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('10', '住所产权证', '住所产权证', '1', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('11', '其他资产证明', '其他资产证明', '0', null, '123465', '1');
INSERT INTO `ast_cert_type` VALUES ('12', '学历证书', '学历证书', '0', null, '123465', '1');

-- ----------------------------
-- Table structure for ast_log
-- ----------------------------
DROP TABLE IF EXISTS `ast_log`;
CREATE TABLE `ast_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apply_id` int(11) unsigned NOT NULL COMMENT '资源申请表ID',
  `log_type` int(11) unsigned NOT NULL COMMENT '日志类型 1修改信息 2资产一审 3风控一审 4资产二审 5风控二审',
  `user_id` int(11) unsigned NOT NULL COMMENT '操作人ID',
  `result` tinyint(3) unsigned NOT NULL COMMENT '操作状态结果：0普通 1成功 2拒绝或失败',
  `data` mediumtext COLLATE utf8_unicode_ci COMMENT '新保存数据',
  `remark` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户备注信息',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='资产变动日志';

-- ----------------------------
-- Records of ast_log
-- ----------------------------
INSERT INTO `ast_log` VALUES ('56', '13', '2', '3', '1', '{\"update_time\":1489741003,\"asset_ck1_remark\":\"罗春  罗玉春  罗玉凤的弟弟 很牛逼 必须要贷\",\"ck1_asset_id\":3,\"status\":2}', null, '1489741003');
INSERT INTO `ast_log` VALUES ('57', '13', '3', '4', '1', '{\"update_time\":1489741077,\"riskctl_ck1_remark\":\"水泥醇！！！！就是我，我要灌水泥\",\"ck1_riskctl_id\":4,\"status\":3,\"ck1_pass_time\":1489741077}', null, '1489741077');
INSERT INTO `ast_log` VALUES ('58', '13', '6', '2', '0', '{\"update_time\":1489741231,\"video_auth\":\"video\\/2017-03-17\\/d8f6deb8060f50acfdc451292b6bee39.mp4\",\"status\":4,\"ck2_submit_time\":1489741231}', null, '1489741231');
INSERT INTO `ast_log` VALUES ('59', '13', '4', '3', '1', '{\"update_time\":1489741320,\"asset_ck2_remark\":\"我同意，请多灌水泥\",\"ck1_asset_id\":3,\"status\":5}', null, '1489741320');
INSERT INTO `ast_log` VALUES ('60', '13', '5', '4', '1', '{\"update_time\":1489741374,\"riskctl_ck2_remark\":null,\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489741374}', null, '1489741374');
INSERT INTO `ast_log` VALUES ('61', '13', '4', '3', '1', '{\"update_time\":1489741777,\"asset_ck2_remark\":\"我同意，请多灌水泥\",\"ck2_asset_id\":3,\"status\":5}', null, '1489741777');
INSERT INTO `ast_log` VALUES ('62', '13', '5', '4', '1', '{\"update_time\":1489741845,\"riskctl_ck2_remark\":null,\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489741845}', null, '1489741845');
INSERT INTO `ast_log` VALUES ('63', '13', '5', '4', '1', '{\"update_time\":1489741904,\"riskctl_ck2_remark\":null,\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489741904}', null, '1489741904');
INSERT INTO `ast_log` VALUES ('64', '13', '5', '4', '1', '{\"update_time\":1489742354,\"riskctl_ck2_remark\":null,\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489742354}', null, '1489742354');
INSERT INTO `ast_log` VALUES ('65', '13', '4', '3', '1', '{\"update_time\":1489742420,\"asset_ck2_remark\":\"我同意，请多灌水泥\",\"ck2_asset_id\":3,\"status\":5}', null, '1489742420');
INSERT INTO `ast_log` VALUES ('66', '13', '5', '4', '1', '{\"update_time\":1489742536,\"riskctl_ck2_remark\":\"试试\",\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489742536}', null, '1489742536');
INSERT INTO `ast_log` VALUES ('67', '13', '5', '4', '1', '{\"update_time\":1489742807,\"riskctl_ck2_remark\":\"水泥不管管水啊\",\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489742807}', null, '1489742807');
INSERT INTO `ast_log` VALUES ('68', '13', '7', '6', '0', '{\"status\":7,\"operator_remark\":\"来啊，发标啊，反正有打吧时光\",\"operator_id\":6,\"publish_time\":1489742887}', null, '1489742887');
INSERT INTO `ast_log` VALUES ('69', '13', '8', '6', '0', '{\"status\":8,\"operator_id\":6,\"full_time\":1489742974}', null, '1489742974');
INSERT INTO `ast_log` VALUES ('70', '13', '9', '5', '0', '{\"status\":13,\"financer_id\":5,\"financer_remark\":\"第三方\",\"finish_loan_time\":1489743011}', null, '1489743011');
INSERT INTO `ast_log` VALUES ('71', '14', '2', '3', '2', '{\"update_time\":1489743670,\"asset_ck1_remark\":\"他诺系~~~~\",\"ck1_asset_id\":3,\"status\":9}', null, '1489743670');
INSERT INTO `ast_log` VALUES ('72', '15', '2', '3', '1', '{\"update_time\":1489743933,\"asset_ck1_remark\":\"丢了\",\"ck1_asset_id\":3,\"status\":2}', null, '1489743933');
INSERT INTO `ast_log` VALUES ('73', '15', '3', '4', '1', '{\"update_time\":1489743958,\"riskctl_ck1_remark\":\"丢完了？\",\"ck1_riskctl_id\":4,\"status\":3,\"ck1_pass_time\":1489743958}', null, '1489743958');
INSERT INTO `ast_log` VALUES ('74', '15', '6', '2', '0', '{\"update_time\":1489744087,\"video_auth\":\"video\\/2017-03-17\\/bc496eb69461edac17379636644c1988.mp4\",\"status\":4,\"ck2_submit_time\":1489744087}', null, '1489744087');
INSERT INTO `ast_log` VALUES ('75', '15', '4', '3', '2', '{\"update_time\":1489744229,\"asset_ck2_remark\":\"啊~~~~~~~~\",\"ck2_asset_id\":3,\"status\":11}', null, '1489744229');
INSERT INTO `ast_log` VALUES ('76', '16', '2', '3', '1', '{\"update_time\":1489744477,\"asset_ck1_remark\":\"你说第一，谁是第二，难道是佳琦！！！！\",\"ck1_asset_id\":3,\"status\":2}', null, '1489744477');
INSERT INTO `ast_log` VALUES ('77', '16', '3', '4', '2', '{\"update_time\":1489744503,\"riskctl_ck1_remark\":\"一般一般世界第三\",\"ck1_riskctl_id\":4,\"status\":10}', null, '1489744503');
INSERT INTO `ast_log` VALUES ('78', '17', '2', '3', '1', '{\"update_time\":1489744717,\"asset_ck1_remark\":\"哇哇哇\",\"ck1_asset_id\":3,\"status\":2}', null, '1489744717');
INSERT INTO `ast_log` VALUES ('79', '17', '3', '4', '1', '{\"update_time\":1489744771,\"riskctl_ck1_remark\":\"呱呱呱\",\"ck1_riskctl_id\":4,\"status\":3,\"ck1_pass_time\":1489744771}', null, '1489744771');
INSERT INTO `ast_log` VALUES ('80', '17', '6', '2', '0', '{\"update_time\":1489744812,\"video_auth\":\"video\\/2017-03-17\\/c120e7ceb26b61c856779061dbfffcfc.mp4\",\"status\":4,\"ck2_submit_time\":1489744812}', null, '1489744812');
INSERT INTO `ast_log` VALUES ('81', '17', '4', '3', '1', '{\"update_time\":1489744873,\"asset_ck2_remark\":\"哦也\",\"ck2_asset_id\":3,\"status\":5}', null, '1489744873');
INSERT INTO `ast_log` VALUES ('82', '17', '5', '4', '2', '{\"update_time\":1489745145,\"riskctl_ck2_remark\":\"滚蛋\",\"ck2_riskctl_id\":4,\"status\":12}', null, '1489745145');
INSERT INTO `ast_log` VALUES ('83', '18', '2', '3', '1', '{\"update_time\":1489749030,\"asset_ck1_remark\":\"大是的发送到\",\"ck1_asset_id\":3,\"status\":2}', null, '1489749030');
INSERT INTO `ast_log` VALUES ('84', '19', '2', '3', '1', '{\"update_time\":1489750780,\"asset_ck1_remark\":\"欧雅茜\",\"ck1_asset_id\":3,\"status\":2}', null, '1489750780');
INSERT INTO `ast_log` VALUES ('85', '23', '1', '2', '0', '{\"repay_type\":1,\"apply_amt\":\"12257.00\",\"deadline\":\"2\",\"deadline_type\":2,\"applier_mobile\":\"18216587895\",\"applier_idcard\":\"310108199210064598\",\"bankcard_no\":\"62278484654659886\",\"bankcard_type\":\"中国银行\",\"clerk_name\":\"004\",\"applier_remark\":null,\"update_time\":1489752231}', null, '1489752231');
INSERT INTO `ast_log` VALUES ('86', '24', '2', '3', '1', '{\"update_time\":1489973582,\"asset_ck1_remark\":\"资产1审\",\"ck1_asset_id\":3,\"status\":2}', null, '1489973583');
INSERT INTO `ast_log` VALUES ('87', '23', '2', '3', '2', '{\"update_time\":1489973600,\"asset_ck1_remark\":\"资产一审拒绝\",\"ck1_asset_id\":3,\"status\":9}', null, '1489973600');
INSERT INTO `ast_log` VALUES ('88', '22', '2', '3', '1', '{\"update_time\":1489973619,\"asset_ck1_remark\":\"资产一审通过\",\"ck1_asset_id\":3,\"status\":2}', null, '1489973619');
INSERT INTO `ast_log` VALUES ('89', '24', '3', '4', '2', '{\"update_time\":1489973698,\"riskctl_ck1_remark\":\"退回修改\",\"ck1_riskctl_id\":4,\"status\":15}', null, '1489973698');
INSERT INTO `ast_log` VALUES ('90', '24', '11', '2', '0', '{\"status\":1,\"update_time\":1489973783}', null, '1489973783');
INSERT INTO `ast_log` VALUES ('91', '24', '11', '2', '0', '{\"status\":1,\"update_time\":1489973839}', null, '1489973839');
INSERT INTO `ast_log` VALUES ('92', '24', '11', '2', '0', '{\"status\":1,\"update_time\":1489973898}', null, '1489973898');
INSERT INTO `ast_log` VALUES ('93', '24', '11', '2', '0', '{\"status\":1,\"update_time\":1489974480}', null, '1489974480');
INSERT INTO `ast_log` VALUES ('94', '24', '2', '3', '1', '{\"update_time\":1489974676,\"asset_ck1_remark\":\"资产1审\\n资产2审\",\"ck1_asset_id\":3,\"status\":2}', null, '1489974676');
INSERT INTO `ast_log` VALUES ('95', '24', '3', '4', '1', '{\"update_time\":1489974717,\"riskctl_ck1_remark\":\"退回修改\\n2.退回修改\",\"ck1_riskctl_id\":4,\"status\":3,\"ck1_pass_time\":1489974717}', null, '1489974717');
INSERT INTO `ast_log` VALUES ('96', '24', '6', '2', '0', '{\"update_time\":1489975061,\"video_auth\":\"video\\/2017-03-20\\/10894c588f25f33ea554b9f3bbae2b4b.mp4\",\"status\":4,\"ck2_submit_time\":1489975061}', null, '1489975061');
INSERT INTO `ast_log` VALUES ('97', '24', '4', '3', '1', '{\"update_time\":1489975110,\"asset_ck2_remark\":null,\"ck2_asset_id\":3,\"status\":5}', null, '1489975110');
INSERT INTO `ast_log` VALUES ('98', '24', '5', '4', '1', '{\"update_time\":1489975165,\"riskctl_ck2_remark\":\"法大大是否\",\"ck2_riskctl_id\":4,\"status\":16}', null, '1489975165');
INSERT INTO `ast_log` VALUES ('99', '24', '6', '2', '0', '{\"update_time\":1489975255,\"video_auth\":\"video\\/2017-03-20\\/1a42370fa4557bd83c9a3c27b95413cf.mp4\",\"status\":4,\"ck2_submit_time\":1489975255}', null, '1489975255');
INSERT INTO `ast_log` VALUES ('100', '24', '6', '2', '0', '{\"update_time\":1489975384,\"video_auth\":\"video\\/2017-03-20\\/8fcd6f3d0739c5469d8c103e9f1b3128.mp4\",\"status\":4,\"ck2_submit_time\":1489975384}', null, '1489975384');
INSERT INTO `ast_log` VALUES ('101', '24', '4', '3', '1', '{\"update_time\":1489975475,\"asset_ck2_remark\":\"大放送大\",\"ck2_asset_id\":3,\"status\":5}', null, '1489975475');
INSERT INTO `ast_log` VALUES ('102', '24', '5', '4', '1', '{\"update_time\":1489975495,\"riskctl_ck2_remark\":\"法大大是否\\n2.发达发送到\",\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489975495}', null, '1489975495');
INSERT INTO `ast_log` VALUES ('103', '24', '7', '6', '0', '{\"status\":7,\"operator_remark\":\"答复\",\"operator_id\":6,\"publish_time\":1489975574}', null, '1489975574');
INSERT INTO `ast_log` VALUES ('104', '24', '8', '6', '0', '{\"status\":8,\"operator_id\":6,\"full_time\":1489975599}', null, '1489975599');
INSERT INTO `ast_log` VALUES ('105', '24', '9', '5', '0', '{\"status\":13,\"financer_id\":5,\"financer_remark\":\"飞士大夫\",\"finish_loan_time\":1489975652}', null, '1489975652');
INSERT INTO `ast_log` VALUES ('106', '22', '3', '4', '1', '{\"update_time\":1489994115,\"riskctl_ck1_remark\":\"法师打发\",\"ck1_riskctl_id\":4,\"status\":3,\"ck1_pass_time\":1489994115}', null, '1489994115');
INSERT INTO `ast_log` VALUES ('107', '22', '6', '2', '0', '{\"update_time\":1489994149,\"video_auth\":\"video\\/2017-03-20\\/3a4c95602673a58e6901a1c32450ef52.mp4\",\"status\":4,\"ck2_submit_time\":1489994149}', null, '1489994149');
INSERT INTO `ast_log` VALUES ('108', '22', '4', '3', '1', '{\"update_time\":1489994168,\"asset_ck2_remark\":\"法法师的\",\"ck2_asset_id\":3,\"status\":5}', null, '1489994168');
INSERT INTO `ast_log` VALUES ('109', '22', '5', '4', '1', '{\"update_time\":1489994182,\"riskctl_ck2_remark\":\"发生大大声的\",\"ck2_riskctl_id\":4,\"status\":6,\"ck2_pass_time\":1489994182}', null, '1489994182');
INSERT INTO `ast_log` VALUES ('110', '22', '7', '6', '0', '{\"status\":7,\"operator_remark\":\"饭打发点\",\"operator_id\":6,\"publish_time\":1489994697}', null, '1489994697');
INSERT INTO `ast_log` VALUES ('111', '22', '8', '6', '0', '{\"status\":8,\"operator_id\":6,\"full_time\":1489994856}', null, '1489994856');

-- ----------------------------
-- Table structure for usr_permission
-- ----------------------------
DROP TABLE IF EXISTS `usr_permission`;
CREATE TABLE `usr_permission` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pname` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名',
  `route` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '路由',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0禁用 1启用 99软删除',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pname` (`pname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限表';

-- ----------------------------
-- Records of usr_permission
-- ----------------------------

-- ----------------------------
-- Table structure for usr_role
-- ----------------------------
DROP TABLE IF EXISTS `usr_role`;
CREATE TABLE `usr_role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名',
  `role_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0禁用 1启用 99软删除',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户角色';

-- ----------------------------
-- Records of usr_role
-- ----------------------------
INSERT INTO `usr_role` VALUES ('1', '超级管理员', '超级管理员，没有任何限制', '123465', null, '1');
INSERT INTO `usr_role` VALUES ('2', '经销', '经销管理员', '123456', null, '1');
INSERT INTO `usr_role` VALUES ('3', '资产', '资产管理员', '123456', null, '1');
INSERT INTO `usr_role` VALUES ('4', '风控', '风控管理员', '123465', null, '1');
INSERT INTO `usr_role` VALUES ('5', '运营', '运营管理员', '123456', null, '1');
INSERT INTO `usr_role` VALUES ('6', '财务', '财务管理员', '123456', null, '1');

-- ----------------------------
-- Table structure for usr_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `usr_role_permission`;
CREATE TABLE `usr_role_permission` (
  `rp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL COMMENT '角色ID',
  `pid` int(11) unsigned NOT NULL COMMENT '权限ID',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0未启用 1启用',
  PRIMARY KEY (`rp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色权限分配表';

-- ----------------------------
-- Records of usr_role_permission
-- ----------------------------

-- ----------------------------
-- Table structure for usr_user
-- ----------------------------
DROP TABLE IF EXISTS `usr_user`;
CREATE TABLE `usr_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `nickname` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '昵称',
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机号',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `role_id` int(11) unsigned NOT NULL COMMENT '角色ID',
  `reg_time` int(11) unsigned NOT NULL COMMENT '注册时间',
  `reg_ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '注册IP',
  `last_time` int(11) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `last_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上次登录IP',
  `this_time` int(11) unsigned DEFAULT NULL COMMENT '本次登录时间',
  `this_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '本次登录IP',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0禁用 1启用 99软删除',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of usr_user
-- ----------------------------
INSERT INTO `usr_user` VALUES ('1', 'jinping', '金平', '15021672361', 'jinping_125@qq.com', '0a94538517f5bc43852a63fed8332e80', '1', '132456', '127.0.0.1', '1489626111', '127.0.0.1', '1489750021', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('2', 'jingxiao', '马克', '15021672230', 'make@admin.com', '0a94538517f5bc43852a63fed8332e80', '2', '123456', '127.0.0.1', '1489975932', '192.168.1.22', '1489994130', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('3', 'zichan', 'zichaner', '15000001236', 'zichan@admin.com', '0a94538517f5bc43852a63fed8332e80', '3', '132465', '127.0.0.1', '1489993848', '127.0.0.1', '1489994160', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('4', 'fengkong', 'F.K', '15022362235', 'fengkong@admin.com', '0a94538517f5bc43852a63fed8332e80', '4', '12356', '127.0.0.1', '1489994175', '192.168.1.22', '1489994307', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('5', 'caiwu', 'C.W', '15655452585', 'caiwu@admin.com', '0a94538517f5bc43852a63fed8332e80', '6', '123456', '127.1.0.1', '1489975616', '192.168.1.22', '1489994981', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('6', 'yunying', 'Y.Y', '15966545215', 'yunying@admin.com', '0a94538517f5bc43852a63fed8332e80', '5', '123456', '127.0.0.1', '1489975515', '192.168.1.22', '1489994320', '192.168.1.22', '1');
INSERT INTO `usr_user` VALUES ('7', 'test1', '测试1', '15666521254', 'fifj@admin.com', '0a94538517f5bc43852a63fed8332e80', '2', '1489635012', '127.0.0.1', null, null, '1489635374', '127.0.0.1', '1');
