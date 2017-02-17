/* This file is created by MySQLReback 2016-07-16 17:56:22 */
 /* 创建表结构 `rrhbt2t8888_apply`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_apply`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_apply` (
  `AL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户申请表',
  `AL_type` varchar(30) DEFAULT '' COMMENT '数据类型',
  `AL_time` datetime DEFAULT NULL COMMENT '提交时间',
  `AL_replyTime` datetime DEFAULT NULL COMMENT '回复时间，管理员处理时间',
  `AL_dataID` int(11) DEFAULT '0' COMMENT '与其它表关联ID',
  `AL_userID` int(11) DEFAULT '0' COMMENT '与用户表关联ID',
  `AL_userName` varchar(50) DEFAULT '' COMMENT '申请用户名，管理列表显示',
  `AL_contact` text COMMENT '联系方式，管理列表显示第一个',
  `AL_userInfo` text COMMENT '用户其它相关信息',
  `AL_subIP` varchar(50) DEFAULT NULL COMMENT '信息提交IP',
  `AL_otherInfo` text COMMENT '其它信息',
  `AL_note` text COMMENT '申请说明',
  `AL_reply` text COMMENT '管理员备注信息',
  `AL_status` smallint(1) DEFAULT '0' COMMENT '处理状态，0-未处理，1-已处理',
  PRIMARY KEY (`AL_ID`),
  KEY `MA_dataID` (`AL_dataID`),
  KEY `MA_ID` (`AL_ID`),
  KEY `MA_userID` (`AL_userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_area_china`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_area_china`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_area_china` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户订单表',
  `type` smallint(1) DEFAULT '0',
  `name` varchar(30) DEFAULT '',
  `parent_id` int(11) DEFAULT '0' COMMENT '状态修改时间',
  `zip` varchar(11) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_area_world`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_area_world`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_area_world` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户订单表',
  `type` smallint(1) DEFAULT '0',
  `name` varchar(30) DEFAULT '',
  `parent_id` int(11) DEFAULT '0' COMMENT '状态修改时间',
  `zip` varchar(11) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_attribute`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_attribute`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_attribute` (
  `AB_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品属性-商品类型',
  `AB_atid` int(11) DEFAULT '0' COMMENT '商品类型ID，attrtype',
  `AB_theme` varchar(200) DEFAULT '' COMMENT '名称',
  `AB_rank` int(11) DEFAULT '0',
  `AB_status` smallint(1) DEFAULT '1',
  `AB_editMode` smallint(1) DEFAULT '0' COMMENT '属性编辑方式',
  `AB_values` text COMMENT '属性可选值列表',
  PRIMARY KEY (`AB_ID`),
  UNIQUE KEY `IM_ID` (`AB_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_attrtype`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_attrtype`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_attrtype` (
  `AT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品属性-商品类型',
  `AT_theme` varchar(200) DEFAULT '' COMMENT '名称',
  `AT_rank` int(11) DEFAULT '0',
  `AT_status` smallint(1) DEFAULT '1',
  `AT_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`AT_ID`),
  UNIQUE KEY `IM_ID` (`AT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_backupdatabase`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_backupdatabase`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_backupdatabase` (
  `BD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BD_time` datetime DEFAULT NULL,
  `BD_type` varchar(25) DEFAULT NULL,
  `BD_filePartNum` smallint(6) DEFAULT NULL,
  `BD_filePath` varchar(200) DEFAULT NULL,
  `BD_fileSize` int(11) DEFAULT '0',
  `BD_tableStr` varchar(4000) DEFAULT NULL,
  `BD_note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`BD_ID`),
  KEY `BB_ID` (`BD_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_cart`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_cart`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_cart` (
  `CR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车',
  `CR_time` datetime DEFAULT NULL COMMENT '添加时间',
  `CR_userID` int(11) DEFAULT '0' COMMENT '用户ID',
  `CR_goodsID` int(11) DEFAULT '0' COMMENT '商品ID',
  `CR_num` int(11) DEFAULT '0' COMMENT '购买数量',
  PRIMARY KEY (`CR_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_case`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_case`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_case` (
  `CS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CS_time` datetime DEFAULT NULL,
  `CS_revTime` datetime DEFAULT NULL,
  `CS_type` varchar(30) DEFAULT NULL,
  `CS_type1ID` int(11) DEFAULT '0',
  `CS_type2ID` int(11) DEFAULT '0',
  `CS_theme` varchar(100) DEFAULT NULL,
  `CS_webImg` text,
  `CS_webImgs` text,
  `CS_rank` int(11) DEFAULT '0',
  `CS_content` longtext,
  `CS_readNum` int(11) DEFAULT '0',
  `CS_isIndex` smallint(1) DEFAULT '0',
  `CS_seokeyword` longtext,
  `CS_seodesc` longtext,
  PRIMARY KEY (`CS_ID`),
  UNIQUE KEY `CS_ID` (`CS_ID`),
  KEY `CS_readNum` (`CS_readNum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_comment`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_comment`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_comment` (
  `CM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户评论表',
  `CM_type` varchar(30) DEFAULT '' COMMENT '数据类型',
  `CM_time` datetime DEFAULT NULL COMMENT '提交时间',
  `CM_replyTime` datetime DEFAULT NULL COMMENT '回复时间',
  `CM_dataID` int(11) DEFAULT '0' COMMENT '与其它表关联ID',
  `CM_level` smallint(1) DEFAULT '1' COMMENT '评论等级',
  `CM_userID` int(11) DEFAULT '0' COMMENT '与用户表关联ID',
  `CM_userName` varchar(50) DEFAULT '' COMMENT '用户名，管理列表显示',
  `CM_contact` text COMMENT '联系方式',
  `CM_userInfo` text COMMENT '用户其它相关信息',
  `CM_subIP` varchar(50) DEFAULT NULL COMMENT '信息提交IP',
  `CM_otherInfo` text COMMENT '其它信息',
  `CM_note` text COMMENT '评论内容',
  `CM_reply` text COMMENT '管理员回复内容',
  `CM_status` smallint(1) DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`CM_ID`),
  KEY `MA_dataID` (`CM_dataID`),
  KEY `MA_ID` (`CM_ID`),
  KEY `MA_userID` (`CM_userID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_download`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_download`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_download` (
  `DL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DL_time` datetime NOT NULL,
  `DL_revTime` datetime DEFAULT NULL,
  `DL_type` varchar(50) DEFAULT NULL,
  `DL_type1ID` int(11) DEFAULT '0',
  `DL_type2ID` int(11) DEFAULT '0',
  `DL_theme` varchar(200) DEFAULT '' COMMENT '下载标题',
  `DL_webImg` varchar(80) DEFAULT '' COMMENT '封面图片',
  `DL_fileName` varchar(80) DEFAULT '' COMMENT '下载文件名',
  `DL_resource` varchar(250) DEFAULT '' COMMENT '外部资源',
  `DL_content` longtext,
  `DL_rank` int(11) DEFAULT '0',
  `DL_readNum` int(11) DEFAULT '0',
  `DL_seodesc` longtext,
  `DL_seokeyword` longtext,
  PRIMARY KEY (`DL_ID`),
  KEY `IF_ID` (`DL_ID`),
  KEY `IF_menu1` (`DL_type1ID`),
  KEY `IF_readNum` (`DL_readNum`),
  KEY `IF_type1ID` (`DL_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_drrz`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_drrz`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_drrz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `user` varchar(60) DEFAULT NULL,
  `leixin` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_drrz` */
 INSERT INTO `rrhbt2t8888_drrz` VALUES ('1','2016-07-15 10:39:00','112.95.136.118','admin','1'),('2','2016-07-16 10:48:36','79.134.255.200','admin','1'),('3','2016-07-16 17:12:07','59.55.60.51','admin','1'),('4','2016-07-16 17:16:44','59.55.60.51','admin','1'),('5','2016-07-16 17:23:21','112.93.112.184','admin','1'),('6','2016-07-16 17:28:11','59.55.60.51','admin','1');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_financial`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_financial`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_financial` (
  `FC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员财务明细',
  `FC_type` varchar(30) DEFAULT '' COMMENT '类型',
  `FC_time` datetime DEFAULT NULL COMMENT '添加时间',
  `FC_userID` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `FC_income` float(11,2) DEFAULT '0.00' COMMENT '收入/充值金额',
  `FC_expend` float(11,2) DEFAULT '0.00' COMMENT '消费/支出金额',
  `FC_remain` float(11,2) DEFAULT '0.00' COMMENT '当前账户余额',
  `FC_note` varchar(80) DEFAULT '' COMMENT '摘要',
  PRIMARY KEY (`FC_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_goods`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_goods`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_goods` (
  `GD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GD_time` datetime DEFAULT NULL,
  `GD_revTime` datetime DEFAULT NULL,
  `GD_type` varchar(30) DEFAULT NULL,
  `GD_typeID` int(11) DEFAULT '0',
  `GD_attrID` int(11) DEFAULT '0' COMMENT '商品类型ID',
  `GD_theme` varchar(100) DEFAULT NULL,
  `GD_unit` varchar(5) DEFAULT '' COMMENT '商品单位',
  `GD_price` float(11,2) DEFAULT '0.00',
  `GD_number` varchar(80) DEFAULT '' COMMENT '商品编号',
  `GD_size` varchar(60) DEFAULT '' COMMENT '商品规格',
  `GD_webImg` text,
  `GD_webImgs` text,
  `GD_group` varchar(30) DEFAULT '' COMMENT '商品推荐组合ID',
  `GD_rank` int(11) DEFAULT '0',
  `GD_content` longtext,
  `GD_attr` text COMMENT '商品属性',
  `GD_readNum` int(11) DEFAULT '0',
  `GD_buyNum` int(11) DEFAULT '0' COMMENT '已下单数量',
  `GD_commend` varchar(30) DEFAULT '',
  `GD_stock` smallint(1) DEFAULT '1' COMMENT '商品库存,0-缺货，1-有货',
  `GD_status` smallint(1) DEFAULT '1' COMMENT '是否显示',
  `GD_seokeyword` longtext,
  `GD_seodesc` longtext,
  PRIMARY KEY (`GD_ID`),
  UNIQUE KEY `CS_ID` (`GD_ID`),
  KEY `CS_readNum` (`GD_readNum`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_goodsaction`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_goodsaction`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_goodsaction` (
  `GA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品活动表',
  `GA_type` varchar(50) NOT NULL DEFAULT '' COMMENT '数据类型，区分不同活动',
  `GA_time` datetime DEFAULT NULL COMMENT '数据添加时间',
  `GA_gdid` int(11) NOT NULL DEFAULT '0' COMMENT '参与活动商品',
  `GA_rank` int(11) DEFAULT '0',
  `GA_webImg` varchar(80) DEFAULT '',
  `GA_startTime` datetime DEFAULT NULL COMMENT '活动开始时间',
  `GA_endTime` datetime DEFAULT NULL COMMENT '活动结束时间',
  `GA_gdprice` float(11,2) DEFAULT '0.00' COMMENT '参与活动价',
  `GA_gdnum` int(11) DEFAULT '0' COMMENT '参与活动的商品数量上限，0-不限',
  `GA_person` int(11) DEFAULT '0' COMMENT '启动活动的参与人数（0-不限）',
  `GA_buyNum` int(11) DEFAULT '0' COMMENT '已下订单数量',
  `GA_otherInfo` text COMMENT '商品活动的其它信息',
  `GA_note` text COMMENT '活动说明',
  `GA_readNum` int(11) DEFAULT '0',
  `GA_seoTitle` varchar(300) DEFAULT NULL,
  `GA_seoWord` text,
  `GA_seoDesc` text,
  PRIMARY KEY (`GA_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_goodsattr`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_goodsattr`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_goodsattr` (
  `GA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品属性值',
  `GA_gdid` int(11) DEFAULT '0',
  `GA_abid` int(11) DEFAULT '0',
  `GA_value` varchar(100) DEFAULT '',
  PRIMARY KEY (`GA_ID`),
  UNIQUE KEY `IM_ID` (`GA_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_goodstype`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_goodstype`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_goodstype` (
  `GT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GT_type` varchar(30) DEFAULT '' COMMENT '数据类型',
  `GT_fid` int(11) DEFAULT '0' COMMENT '父级ID',
  `GT_theme` varchar(60) DEFAULT '' COMMENT '商品分类名称',
  `GT_typeImg` varchar(80) DEFAULT '' COMMENT '商品分类图片',
  `GT_level` int(11) DEFAULT '0' COMMENT '栏目等级',
  `GT_rank` int(11) DEFAULT '0' COMMENT '分类排序',
  `GT_status` smallint(1) DEFAULT '1' COMMENT '分类状态，是否显示',
  `GT_commend` smallint(1) DEFAULT '0' COMMENT '是否推荐',
  `GT_seoTitle` varchar(200) DEFAULT NULL,
  `GT_seoDesc` text,
  `GT_seoWord` text,
  PRIMARY KEY (`GT_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_hiring`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_hiring`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_hiring` (
  `HR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HR_time` datetime DEFAULT NULL COMMENT '发布时间',
  `HR_revTime` datetime DEFAULT NULL,
  `HR_endTime` datetime DEFAULT NULL COMMENT '结束日期',
  `HR_type` varchar(50) DEFAULT '',
  `HR_type1ID` int(11) DEFAULT '0',
  `HR_type2ID` int(11) DEFAULT '0',
  `HR_theme` varchar(250) DEFAULT '' COMMENT '招聘职位',
  `HR_address` varchar(100) DEFAULT '' COMMENT '工作地点',
  `HR_number` varchar(20) DEFAULT '' COMMENT '招聘人数',
  `HR_wages` varchar(30) DEFAULT '' COMMENT '工资待遇',
  `HR_content` longtext COMMENT '详细说明',
  `HR_rank` int(11) DEFAULT '0',
  `HR_readNum` int(11) DEFAULT '0',
  `HR_seodesc` varchar(350) DEFAULT '',
  `HR_seokeyword` varchar(350) DEFAULT '',
  PRIMARY KEY (`HR_ID`),
  KEY `IF_ID` (`HR_ID`),
  KEY `IF_menu1` (`HR_type1ID`),
  KEY `IF_readNum` (`HR_readNum`),
  KEY `IF_type1ID` (`HR_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_images`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_images`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_images` (
  `IA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IA_type` varchar(40) DEFAULT NULL,
  `IA_typeID` int(11) DEFAULT '0',
  `IA_theme` varchar(80) DEFAULT NULL,
  `IA_rank` int(11) DEFAULT '0',
  `IA_img` varchar(30) DEFAULT NULL,
  `IA_URL` varchar(120) DEFAULT NULL,
  `IA_note` longtext,
  `IA_othersItem` varchar(250) DEFAULT NULL,
  `IA_state` smallint(1) DEFAULT '1',
  PRIMARY KEY (`IA_ID`),
  KEY `IA_ID` (`IA_ID`),
  KEY `IA_typeID` (`IA_typeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_info`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_info`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_info` (
  `IF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IF_time` datetime NOT NULL,
  `IF_revTime` datetime DEFAULT NULL,
  `IF_type` varchar(50) DEFAULT NULL,
  `IF_type1ID` int(11) DEFAULT '0',
  `IF_type2ID` int(11) DEFAULT '0',
  `IF_theme` varchar(250) DEFAULT NULL,
  `IF_webImg` varchar(255) DEFAULT '',
  `IF_content` longtext,
  `IF_rank` int(11) DEFAULT '0',
  `IF_readNum` int(11) DEFAULT '0',
  `IF_isIndex` smallint(1) DEFAULT '0',
  `IF_seodesc` longtext,
  `IF_seokeyword` longtext,
  `zt` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IF_ID`),
  KEY `IF_ID` (`IF_ID`),
  KEY `IF_menu1` (`IF_type1ID`),
  KEY `IF_readNum` (`IF_readNum`),
  KEY `IF_type1ID` (`IF_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_infotype`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_infotype`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_infotype` (
  `IT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IT_type` varchar(40) DEFAULT NULL,
  `IT_themeType` varchar(30) DEFAULT NULL,
  `IT_type1ID` int(11) DEFAULT '0',
  `IT_theme` varchar(50) DEFAULT NULL,
  `IT_alias` varchar(50) DEFAULT '' COMMENT '栏目别名',
  `IT_rank` int(11) DEFAULT '0',
  `IT_typeImg` varchar(60) DEFAULT NULL,
  `IT_note` text COMMENT '栏目描述',
  `IT_seoTitle` varchar(100) DEFAULT '' COMMENT 'SEO',
  `IT_seoDesc` text,
  `IT_seoWord` text,
  PRIMARY KEY (`IT_ID`),
  KEY `IT_ID` (`IT_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_infoweb`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_infoweb`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_infoweb` (
  `IW_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IW_type` varchar(50) NOT NULL,
  `IW_theme` varchar(60) DEFAULT '',
  `IW_alias` varchar(60) DEFAULT '',
  `IW_content` longtext,
  `IW_rank` int(11) DEFAULT '0',
  `IW_typeImg` varchar(30) DEFAULT '' COMMENT '栏目图片',
  `IW_seotitle` varchar(250) DEFAULT NULL,
  `IW_seodesc` longtext,
  `IW_seokeyword` longtext,
  PRIMARY KEY (`IW_ID`),
  KEY `WB_ID` (`IW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_integral`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_integral`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_integral` (
  `IG_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '积分商品表',
  `IG_time` datetime DEFAULT NULL,
  `IG_revTime` datetime DEFAULT NULL,
  `IG_type` varchar(30) DEFAULT NULL,
  `IG_typeID` int(11) DEFAULT '0',
  `IG_theme` varchar(100) DEFAULT NULL,
  `IG_integral` float(11,2) DEFAULT '0.00',
  `IG_number` varchar(80) DEFAULT '' COMMENT '商品编号',
  `IG_size` varchar(60) DEFAULT '' COMMENT '商品规格',
  `IG_webImg` text,
  `IG_webImgs` text,
  `IG_group` varchar(30) DEFAULT '' COMMENT '商品推荐组合ID',
  `IG_rank` int(11) DEFAULT '0',
  `IG_content` longtext,
  `IG_attr` text COMMENT '商品属性',
  `IG_readNum` int(11) DEFAULT '0',
  `IG_commend` varchar(30) DEFAULT '',
  `IG_stock` smallint(1) DEFAULT '1' COMMENT '商品库存,0-缺货，1-有货',
  `IG_seokeyword` longtext,
  `IG_seodesc` longtext,
  PRIMARY KEY (`IG_ID`),
  UNIQUE KEY `CS_ID` (`IG_ID`),
  KEY `CS_readNum` (`IG_readNum`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_ip`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_ip`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `leixin` varchar(255) NOT NULL DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_jsbz`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_jsbz`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_jsbz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zffs1` int(8) NOT NULL DEFAULT '0',
  `zffs2` int(8) NOT NULL DEFAULT '0',
  `zffs3` int(8) NOT NULL DEFAULT '0',
  `jb` decimal(15,0) NOT NULL DEFAULT '0',
  `zt` int(8) NOT NULL DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `qr_zt` int(8) DEFAULT '0',
  `user_tjr` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_nc` varchar(255) DEFAULT NULL,
  `qb` varchar(20) DEFAULT NULL,
  `old_gid` int(11) NOT NULL DEFAULT '0',
  `qd` tinyint(1) NOT NULL DEFAULT '0' COMMENT '判断是否添加到抢单',
  `qdo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被抢过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_link`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_link`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_link` (
  `LN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LN_type` varchar(20) NOT NULL,
  `LN_theme` varchar(200) DEFAULT NULL,
  `LN_rank` int(11) DEFAULT '0',
  `LN_state` smallint(1) DEFAULT '1',
  `LN_imgMode` varchar(20) DEFAULT NULL,
  `LN_imgUrl` varchar(200) DEFAULT NULL,
  `LN_webUrl` varchar(200) DEFAULT NULL,
  `LN_time` datetime DEFAULT NULL,
  PRIMARY KEY (`LN_ID`),
  UNIQUE KEY `IM_ID` (`LN_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_logusers`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_logusers`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_logusers` (
  `LU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LU_time` datetime DEFAULT NULL,
  `LU_userName` varchar(35) DEFAULT NULL,
  `LU_userID` int(11) DEFAULT '0',
  `LU_type` varchar(35) DEFAULT NULL,
  `LU_note` longtext,
  PRIMARY KEY (`LU_ID`),
  KEY `LU_ID` (`LU_ID`),
  KEY `LU_userID` (`LU_userID`),
  KEY `LU_userID1` (`LU_userName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_member`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_member`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_member` (
  `MB_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MB_time` date DEFAULT NULL,
  `MB_loginTime` datetime DEFAULT NULL,
  `MB_loginNum` int(11) DEFAULT '0',
  `MB_loginIP` varchar(20) DEFAULT NULL,
  `MB_realname` varchar(30) DEFAULT NULL,
  `MB_username` varchar(30) NOT NULL,
  `MB_userpwd` varchar(32) NOT NULL,
  `MB_userKey` varchar(36) DEFAULT NULL,
  `MB_right` int(11) DEFAULT '20',
  `MB_userGroup` int(11) DEFAULT '0',
  `MB_rightStr` longtext,
  `MB_itemNum` int(11) DEFAULT '20',
  PRIMARY KEY (`MB_ID`),
  KEY `MB_itemNum` (`MB_itemNum`),
  KEY `MB_loginNum` (`MB_loginNum`),
  KEY `MB_userKey` (`MB_userKey`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_member` */
 INSERT INTO `rrhbt2t8888_member` VALUES ('27',null,null,'0',null,null,'admin','e10adc3949ba59abbe56e057f20f883e',null,'1','0',null,'20'),('39',null,null,'0',null,null,'abqiang520','5c67af1abce23ba41992576d94a3041b',null,'1','0',null,'20');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_memberlog`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_memberlog`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_memberlog` (
  `ML_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ML_time` datetime NOT NULL,
  `ML_date` date NOT NULL,
  `ML_userID` int(11) NOT NULL,
  `ML_realname` varchar(30) NOT NULL,
  `ML_ip` varchar(20) NOT NULL,
  `ML_ipCN` varchar(50) NOT NULL,
  `ML_menuFileID` mediumint(9) NOT NULL DEFAULT '0',
  `ML_note` varchar(255) DEFAULT NULL,
  `ML_readNum` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ML_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_menufile`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_menufile`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_menufile` (
  `MF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MF_level` int(11) DEFAULT '0',
  `MF_fileID` int(11) DEFAULT '0',
  `MF_theme` varchar(50) DEFAULT NULL,
  `MF_fileName` varchar(35) DEFAULT NULL,
  `MF_getMudi` varchar(16) DEFAULT NULL,
  `MF_example` varchar(160) DEFAULT NULL,
  `MF_rank` int(11) DEFAULT '0',
  `MF_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MF_ID`),
  KEY `MF_fileID` (`MF_fileID`),
  KEY `MF_ID` (`MF_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_menutree`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_menutree`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_menutree` (
  `MT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MT_level` int(11) DEFAULT '0',
  `MT_menuID` int(11) DEFAULT '0',
  `MT_fileID` int(11) DEFAULT '0',
  `MT_theme` varchar(50) DEFAULT NULL,
  `MT_fileName` varchar(25) DEFAULT NULL,
  `MT_getMudi` varchar(20) DEFAULT NULL,
  `MT_getDataMode` varchar(50) DEFAULT NULL,
  `MT_getDataModeStr` varchar(50) DEFAULT NULL,
  `MT_getDataType` varchar(20) DEFAULT NULL,
  `MT_getDataTypeCN` varchar(50) DEFAULT NULL,
  `MT_getDataType2` varchar(20) DEFAULT NULL,
  `MT_getDataID` int(11) DEFAULT '0',
  `MT_getImgSize` varchar(60) DEFAULT '',
  `MT_getImgSize2` varchar(60) DEFAULT '',
  `MT_getOthers` varchar(160) DEFAULT NULL,
  `MT_URL` varchar(200) DEFAULT NULL,
  `MT_rank` int(11) DEFAULT '0',
  `MT_state` int(11) DEFAULT '0',
  PRIMARY KEY (`MT_ID`),
  KEY `MT_fileID` (`MT_fileID`),
  KEY `MT_ID` (`MT_ID`),
  KEY `MT_menuID` (`MT_menuID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_message`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_message`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_message` (
  `MA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '前台提交信息，留言、申请等',
  `MA_type` varchar(30) DEFAULT '' COMMENT '数据类型',
  `MA_theme` varchar(60) DEFAULT '' COMMENT '留言主题',
  `MA_time` datetime DEFAULT NULL COMMENT '提交时间',
  `MA_replyTime` datetime DEFAULT NULL COMMENT '回复时间',
  `MA_dataID` int(11) DEFAULT '0' COMMENT '与其它表关联ID',
  `MA_userID` int(11) DEFAULT '0' COMMENT '与用户表关联ID',
  `MA_userName` varchar(50) DEFAULT '' COMMENT '留言用户名，管理列表显示',
  `MA_contact` text COMMENT '联系方式',
  `MA_userInfo` text COMMENT '用户其它相关信息',
  `MA_subIP` varchar(50) DEFAULT NULL COMMENT '信息提交IP',
  `MA_otherInfo` text COMMENT '其它信息',
  `MA_note` text COMMENT '用户留言内容',
  `MA_reply` text COMMENT '管理员回复内容',
  `MA_status` smallint(1) DEFAULT '0' COMMENT '审核状态',
  `zt` int(8) NOT NULL DEFAULT '0',
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MA_ID`),
  KEY `MA_dataID` (`MA_dataID`),
  KEY `MA_ID` (`MA_ID`),
  KEY `MA_userID` (`MA_userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_mobmsgset`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_mobmsgset`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_mobmsgset` (
  `SYS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SYS_theme` varchar(100) DEFAULT NULL,
  `SYS_address` varchar(200) DEFAULT NULL,
  `SYS_postCode` varchar(50) DEFAULT NULL,
  `SYS_contact` varchar(50) DEFAULT '',
  `SYS_mobile` varchar(50) DEFAULT '',
  `SYS_mail` varchar(80) DEFAULT NULL,
  `SYS_phone` varchar(50) DEFAULT NULL,
  `SYS_hotPhone` varchar(50) DEFAULT NULL,
  `SYS_fax` varchar(50) DEFAULT NULL,
  `SYS_qq` varchar(30) DEFAULT NULL,
  `SYS_banquan` varchar(100) DEFAULT NULL,
  `SYS_seoTitle` varchar(300) DEFAULT '',
  `SYS_seoWord` text,
  `SYS_seoDesc` text,
  PRIMARY KEY (`SYS_ID`),
  KEY `SYS_postCode` (`SYS_postCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_order`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_order`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_order` (
  `OD_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户订单表',
  `OD_type` varchar(30) DEFAULT '' COMMENT '订单类型',
  `OD_time` datetime DEFAULT NULL COMMENT '添加时间',
  `OD_revTime` datetime DEFAULT NULL COMMENT '状态修改时间',
  `OD_sn` varchar(60) DEFAULT '' COMMENT '订单编号',
  `OD_userID` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `OD_dataID` varchar(30) DEFAULT '' COMMENT '商品ID字符患，用于统计已订购数量',
  `OD_address` text COMMENT '收货地址',
  `OD_goods` text COMMENT '商品信息',
  `OD_ship` text COMMENT '物流配送信息',
  `OD_pay` smallint(1) DEFAULT '1' COMMENT '支付方式,0-货到付款;1-支付宝',
  `OD_gMoney` float(11,2) DEFAULT '0.00' COMMENT '本次订单的商品总价',
  `OD_sMoney` float(11,2) DEFAULT '0.00' COMMENT '本次订单的物流费用',
  `OD_status` varchar(5) DEFAULT '000' COMMENT '订单状态',
  `OD_tradeOn` varchar(60) DEFAULT '' COMMENT '支付宝交易号',
  `OD_shipSN` varchar(60) DEFAULT '' COMMENT '物流单号',
  PRIMARY KEY (`OD_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_orderinte`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_orderinte`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_orderinte` (
  `OI_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户积分商品订单表',
  `OI_type` varchar(30) DEFAULT '' COMMENT '订单类型',
  `OI_time` datetime DEFAULT NULL COMMENT '添加时间',
  `OI_revTime` datetime DEFAULT NULL COMMENT '状态修改时间',
  `OI_sn` varchar(60) DEFAULT '' COMMENT '订单编号',
  `OI_userID` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `OI_address` text COMMENT '收货地址',
  `OI_goods` text COMMENT '积分商品信息',
  `OI_ship` text COMMENT '物流配送信息',
  `OI_pay` smallint(1) DEFAULT '1' COMMENT '支付方式,0-货到付款;1-支付宝',
  `OI_integral` float(11,2) DEFAULT '0.00' COMMENT '本次订单所需积分',
  `OI_sMoney` float(11,2) DEFAULT '0.00' COMMENT '本次订单的物流费用',
  `OI_status` varchar(5) DEFAULT '600' COMMENT '订单状态',
  PRIMARY KEY (`OI_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_orderstatus`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_orderstatus`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_orderstatus` (
  `OS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单状态表',
  `OS_time` datetime DEFAULT NULL COMMENT '添加时间',
  `OS_theme` varchar(200) DEFAULT '' COMMENT '名称',
  `OS_code` varchar(10) DEFAULT '' COMMENT '状态代码',
  `OS_note` varchar(300) DEFAULT '' COMMENT '备注',
  `OS_rank` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`OS_ID`),
  UNIQUE KEY `IM_ID` (`OS_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_pai`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_pai`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_pai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `zt` varchar(255) DEFAULT NULL,
  `sc_date` datetime DEFAULT NULL,
  `sy_user` varchar(255) NOT NULL DEFAULT '0',
  `sy_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_pai` */
 INSERT INTO `rrhbt2t8888_pai` VALUES ('1','niuniu','ca9b24fd3eb3b869ca2a2eb752dd5b01','0','2016-07-16 17:31:06','0',null),('2','niuniu','8f7da0fe54d75e271ffbfd9c3aa2a697','0','2016-07-16 17:31:06','0',null),('3','niuniu','ad81a51c1fd11a56127d7efa95fcccb7','0','2016-07-16 17:31:06','0',null),('4','niuniu','a0937a80dacea86ea158042424824f9e','0','2016-07-16 17:31:06','0',null),('5','niuniu','b66956634dad4152632b3045b375243f','0','2016-07-16 17:31:06','0',null),('6','niuniu','74333a74bcf8d10d34068d67117f42fb','0','2016-07-16 17:31:06','0',null),('7','niuniu','9817372be8e1c3a5a559ff28b8a0df21','0','2016-07-16 17:31:06','0',null),('8','niuniu','0b02f3025bed1120202885b559027c74','0','2016-07-16 17:31:06','0',null),('9','niuniu','66012345905dc87408c514237bdbff0a','0','2016-07-16 17:31:06','0',null),('10','niuniu','0ec8202f3eee450bccfbe7c01151b842','0','2016-07-16 17:31:06','0',null),('11','778899','b87865a573ce58b44f45775d2bf2602e','0','2016-07-16 17:44:28','0',null),('12','778899','f532b2f64e9781d29bb76f063d51fa3a','0','2016-07-16 17:44:28','0',null),('13','778899','6c040e5164b91e40e9ea0429748bf6b1','0','2016-07-16 17:44:28','0',null),('14','778899','083fe0004d7f1425b75d4e9ca3888cf5','0','2016-07-16 17:44:28','0',null),('15','778899','5711fcdfaaf1b70c0239f2acc04a3290','0','2016-07-16 17:44:28','0',null),('16','778899','034bb11bbb4973a53ef442f690662117','0','2016-07-16 17:44:28','0',null),('17','778899','7caa860775c60f66b2fdf4714d4bd745','0','2016-07-16 17:44:28','0',null),('18','778899','d8d211deac7933a093e33412fb1d0b51','0','2016-07-16 17:44:28','0',null),('19','778899','965a44e567cfbf1227512698c8276d56','0','2016-07-16 17:44:28','0',null),('20','778899','07d5f80fbf52b3c9147ca1b1934ef1d2','0','2016-07-16 17:44:28','0',null);/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_pin`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_pin`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_pin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `zt` varchar(255) DEFAULT NULL,
  `sc_date` datetime DEFAULT NULL,
  `sy_user` varchar(255) NOT NULL DEFAULT '0',
  `sy_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_pin` */
 INSERT INTO `rrhbt2t8888_pin` VALUES ('1','niuniu','d81c9184401a549037108607ab19c31e','1','2016-07-16 17:30:58','0',null),('2','niuniu','42c3a44dfa3674ea98af02f56522b604','0','2016-07-16 17:30:58','0',null),('3','niuniu','ffdac89a91c57a45feed0a74244dd219','0','2016-07-16 17:30:58','0',null),('4','niuniu','e59ebf4cb3b5f8e52b8710fda75a339c','0','2016-07-16 17:30:58','0',null),('5','niuniu','ef40d06d031979a87059c30c9573fdb3','0','2016-07-16 17:30:58','0',null),('6','niuniu','9278d2f7d6e9b9e582f9620f4c495b21','0','2016-07-16 17:30:58','0',null),('7','niuniu','8710efd83ae0c74f92f263be5cd32a5e','0','2016-07-16 17:30:58','0',null),('8','niuniu','2b889c6809cf92a8147644c21f773a89','0','2016-07-16 17:30:58','0',null),('9','niuniu','a10767fd0a52775215bf26a35808702c','0','2016-07-16 17:30:58','0',null),('10','niuniu','b153596f58bcb63ed9d760be0cca7253','0','2016-07-16 17:30:58','0',null),('11','778899','01fcc42067b117edb40d4097dbbddb23','1','2016-07-16 17:44:22','0',null),('12','778899','47dbe02936fc9a570be14d8848ab63cf','0','2016-07-16 17:44:22','0',null),('13','778899','d8d246d0c39fe9b9591a0fa5784468be','0','2016-07-16 17:44:22','0',null),('14','778899','9988cd7bfbb893ccb0d50d1e3605a31a','0','2016-07-16 17:44:22','0',null),('15','778899','5934626a99f6351e9122af09991a8ae9','0','2016-07-16 17:44:22','0',null),('16','778899','336a31495e9b62840b7c230e5d8a9895','0','2016-07-16 17:44:22','0',null),('17','778899','c796a0bc8f041711b082027252ae95ae','0','2016-07-16 17:44:22','0',null),('18','778899','b1c40165c8ea81bf1b3c8f282c20cbc5','0','2016-07-16 17:44:22','0',null),('19','778899','244db9b7d6c0e28c8d514b3b62471020','0','2016-07-16 17:44:22','0',null),('20','778899','f24cf49233973f04610c6061cfc9f2b4','0','2016-07-16 17:44:22','0',null),('21','ab123456','3220899b46ce2774b65c7e8b65a2fe85','1','2016-07-16 17:49:09','0',null),('22','ab123456','06ac95125eaa20a76808c9c92850a167','1','2016-07-16 17:49:09','0',null),('23','ab123456','8035af8c5791fc3128d377223a99e560','0','2016-07-16 17:49:09','0',null),('24','ab123456','44f5730fc8c27a830765f8f98d54a0ee','0','2016-07-16 17:49:09','0',null),('25','ab123456','091d3739405ae27199e60d46d8275d23','0','2016-07-16 17:49:09','0',null),('26','ab123456','d2b7fe39f939bbeccc45d5a2efc81de3','0','2016-07-16 17:49:09','0',null),('27','ab123456','237a8c09c66d087f43230f44ce556d3c','0','2016-07-16 17:49:09','0',null),('28','ab123456','158eb2d5b63a702455f7ad202a73cc59','0','2016-07-16 17:49:09','0',null),('29','ab123456','3afaa2758519c8532e993f5e1963f311','0','2016-07-16 17:49:09','0',null),('30','ab123456','bc1689854fbead22f3cd378329df8209','0','2016-07-16 17:49:09','0',null);/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_ppdd`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_ppdd`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_ppdd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` varchar(255) DEFAULT NULL,
  `g_id` varchar(255) DEFAULT NULL,
  `jb` decimal(15,0) DEFAULT NULL,
  `p_user` varchar(255) DEFAULT NULL,
  `g_user` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `zt` int(8) NOT NULL DEFAULT '0',
  `pic` varchar(255) DEFAULT NULL,
  `zffs1` int(8) DEFAULT NULL,
  `zffs2` int(8) DEFAULT NULL,
  `zffs3` int(8) DEFAULT NULL,
  `ts_zt` int(8) NOT NULL DEFAULT '0',
  `date_hk` datetime DEFAULT NULL,
  `pic2` varchar(255) DEFAULT NULL,
  `dk_ci` int(11) DEFAULT '0' COMMENT '打款次数',
  `sk_ci` int(11) DEFAULT '0' COMMENT '收款次数',
  `old_pid` int(11) NOT NULL DEFAULT '0',
  `old_gid` int(11) NOT NULL DEFAULT '0',
  `is_sms` int(11) NOT NULL DEFAULT '0',
  `zhuangtai` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_ppdd_ly`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_ppdd_ly`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_ppdd_ly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppdd_id` int(14) DEFAULT NULL,
  `user` varchar(14) DEFAULT NULL,
  `nr` text,
  `date` datetime DEFAULT NULL,
  `user_nc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_regusers`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_regusers`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_regusers` (
  `RU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RU_time` datetime DEFAULT NULL COMMENT '注册时间',
  `RU_regIP` varchar(30) DEFAULT '' COMMENT '注册IP',
  `RU_img` varchar(30) DEFAULT '' COMMENT '用户头像',
  `RU_username` varchar(50) DEFAULT NULL COMMENT '用户名，登陆名',
  `RU_userpwd` varchar(150) DEFAULT NULL COMMENT '用户登陆密码',
  `RU_answer` varchar(100) DEFAULT NULL COMMENT '密保问题',
  `RU_question` varchar(200) DEFAULT NULL COMMENT '密保答案',
  `RU_userInfo` text COMMENT '用户信息',
  `RU_contact` text COMMENT '联系信息',
  `RU_otherInfo` text COMMENT '其它信息',
  `RU_note` text COMMENT '管理员备注信息',
  `RU_limit` smallint(1) DEFAULT '0' COMMENT '用户等级，0-普通，1-高级',
  `RU_status` smallint(1) DEFAULT '1' COMMENT '用户状态，1-正常，0-禁止',
  `RU_nowTime` datetime DEFAULT NULL COMMENT '当前登陆时间',
  `RU_nowIP` varchar(80) DEFAULT NULL COMMENT '当前登陆IP',
  `RU_lastTime` datetime DEFAULT NULL COMMENT '上次登录时间',
  `RU_lastIP` varchar(80) DEFAULT NULL COMMENT '上次登陆IP',
  `RU_logNum` int(11) DEFAULT '0' COMMENT '总登录次数',
  `RU_online` int(11) DEFAULT '0' COMMENT '总在线时间',
  PRIMARY KEY (`RU_ID`),
  UNIQUE KEY `UE_ID` (`RU_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_service`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_service`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_service` (
  `SV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SV_type` varchar(20) NOT NULL,
  `SV_time` datetime NOT NULL,
  `SV_rank` int(11) DEFAULT '0',
  `SV_theme` varchar(200) DEFAULT NULL,
  `SV_dataMode` varchar(20) DEFAULT NULL,
  `SV_accounts` varchar(200) DEFAULT NULL,
  `SV_state` int(11) DEFAULT '1',
  PRIMARY KEY (`SV_ID`),
  UNIQUE KEY `IM_ID` (`SV_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_shipping`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_shipping`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_shipping` (
  `SP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '物流表',
  `SP_time` datetime DEFAULT NULL COMMENT '添加时间',
  `SP_theme` varchar(200) DEFAULT '' COMMENT '物流名称',
  `SP_type` varchar(20) DEFAULT '' COMMENT '物流类型',
  `SP_code` varchar(30) DEFAULT '' COMMENT '快递公司代码',
  `SP_price` float(11,2) DEFAULT '0.00' COMMENT '单笔运费',
  `SP_cheap` float(11,2) DEFAULT '0.00' COMMENT '免运费额度',
  `SP_note` varchar(300) DEFAULT '' COMMENT '物流描述',
  `SP_status` smallint(1) DEFAULT '1',
  PRIMARY KEY (`SP_ID`),
  UNIQUE KEY `IM_ID` (`SP_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_shopsj`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_shopsj`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_shopsj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sjmc` varchar(255) DEFAULT NULL,
  `jyxm` varchar(255) DEFAULT NULL,
  `lxfs` varchar(255) DEFAULT NULL,
  `dz` varchar(255) DEFAULT NULL,
  `slt` varchar(255) DEFAULT NULL,
  `content` longtext,
  `user` varchar(255) DEFAULT NULL,
  `zt` int(15) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `leixin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_shopsys`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_shopsys`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_shopsys` (
  `SPS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SPS_defWord` varchar(30) DEFAULT '',
  `SPS_hotWord` varchar(100) DEFAULT NULL,
  `SPS_smtpHost` varchar(30) DEFAULT '' COMMENT 'SMTP服务器',
  `SPS_sendMail` varchar(60) DEFAULT '' COMMENT '发件邮箱地址',
  `SPS_sendPwd` varchar(30) DEFAULT '' COMMENT '发件邮箱密码',
  `SPS_giveMail` varchar(30) DEFAULT '' COMMENT '接收用户意见反馈邮箱',
  `SPS_regInte` int(11) DEFAULT '0' COMMENT '用户注册获得积分',
  `SPS_buyInte` int(11) DEFAULT '0' COMMENT '购买商品获得积分基数',
  `SPS_comInte` int(11) DEFAULT '0' COMMENT '评价获得积分数',
  `SPS_payType` varchar(10) DEFAULT '' COMMENT '支持的支付方式',
  `SPS_zfb_pid` varchar(40) DEFAULT '' COMMENT '合作身份者id',
  `SPS_zfb_key` varchar(40) DEFAULT '' COMMENT '安全检验码',
  `SPS_zfb_mail` varchar(30) DEFAULT '' COMMENT '签约账户',
  `SPS_price` int(11) DEFAULT '0' COMMENT '价格区间设置',
  `SPS_integral` int(11) DEFAULT '0' COMMENT '价格区间设置',
  `SPS_divide` int(11) DEFAULT '0' COMMENT '划分个数',
  PRIMARY KEY (`SPS_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_single`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_single`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_single` (
  `SG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SG_type` varchar(50) DEFAULT NULL,
  `SG_type1ID` int(11) DEFAULT '0',
  `SG_type2ID` int(11) DEFAULT '0',
  `SG_content` longtext,
  PRIMARY KEY (`SG_ID`),
  KEY `WB_ID` (`SG_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_sysadmin`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_sysadmin`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_sysadmin` (
  `SA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SA_adminLoginKey` varchar(36) DEFAULT NULL,
  `SA_skinMode` varchar(25) DEFAULT NULL,
  `SA_isCloseUserMenu` smallint(6) DEFAULT '0',
  `SA_userSaveMode` smallint(6) DEFAULT '0',
  `SA_loginMode` smallint(6) DEFAULT '0',
  PRIMARY KEY (`SA_ID`),
  KEY `SA_ID` (`SA_ID`),
  KEY `SA_key` (`SA_adminLoginKey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_sysimages`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_sysimages`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_sysimages` (
  `SI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SI_isThumb` varchar(10) DEFAULT NULL,
  `SI_thumbW` smallint(6) DEFAULT '0',
  `SI_thumbH` smallint(6) DEFAULT '0',
  `SI_isWatermark` varchar(10) DEFAULT NULL,
  `SI_watermarkPath` varchar(200) DEFAULT NULL,
  `SI_watermarkPos` varchar(16) DEFAULT NULL,
  `SI_watermarkPadding` smallint(6) DEFAULT '0',
  `SI_watermarkFontContent` varchar(20) DEFAULT NULL,
  `SI_watermarkFontSize` smallint(6) DEFAULT '0',
  `SI_watermarkFontColor` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`SI_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_system`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_system`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_system` (
  `SYS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SYS_theme` varchar(100) DEFAULT NULL,
  `SYS_address` varchar(200) DEFAULT NULL,
  `SYS_postCode` varchar(50) DEFAULT NULL,
  `SYS_contact` varchar(50) DEFAULT '',
  `SYS_mobile` varchar(50) DEFAULT '',
  `SYS_mail` varchar(80) DEFAULT NULL,
  `SYS_phone` varchar(50) DEFAULT NULL,
  `SYS_hotPhone` varchar(50) DEFAULT NULL,
  `SYS_fax` varchar(50) DEFAULT NULL,
  `SYS_qq` varchar(30) DEFAULT NULL,
  `SYS_banquan` varchar(100) DEFAULT NULL,
  `SYS_seoTitle` varchar(300) DEFAULT '',
  `SYS_seoWord` text,
  `SYS_seoDesc` text,
  `SPS_smtpHost` varchar(80) DEFAULT NULL,
  `SPS_sendMail` varchar(80) DEFAULT NULL,
  `SPS_sendPwd` varchar(80) DEFAULT NULL,
  `SPS_giveMail` varchar(80) DEFAULT NULL,
  `a_ztj` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '直推荐奖',
  `a_ztj2` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '间推奖',
  `a_ztj3` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '间间推奖',
  `a_bdj` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '报单奖',
  `a_ld8` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ld9` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ld10` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_kd_zsb` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '钻石币开单数量',
  `a_sxf` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '交易大厅手续费',
  `a_btbjg` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '比特币价格',
  `a_fxzl` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '发行总量',
  `a_fuhuo` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '复活费用',
  `a_mrfh_cj` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ybfxsl` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '泫?办行?量',
  `a_zsbfxsl` decimal(15,4) NOT NULL,
  `a_ybhuilv` decimal(15,6) NOT NULL,
  `a_zsbhuilv` decimal(15,6) NOT NULL,
  `a_bdzxds` decimal(15,4) NOT NULL,
  `zt` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SYS_ID`),
  KEY `SYS_postCode` (`SYS_postCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_taobaoset`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_taobaoset`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_taobaoset` (
  `TBS_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TBS_state` tinyint(1) DEFAULT '1',
  `TBS_appkey` varchar(30) DEFAULT '',
  `TBS_secret` varchar(150) DEFAULT '',
  PRIMARY KEY (`TBS_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_task`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_task`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_task` (
  `MA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '前台提交信息，留言、申请等',
  `MA_type` varchar(30) DEFAULT '' COMMENT '数据类型',
  `MA_theme` varchar(60) DEFAULT '' COMMENT '留言主题',
  `MA_time` datetime DEFAULT NULL COMMENT '提交时间',
  `MA_replyTime` datetime DEFAULT NULL COMMENT '回复时间',
  `MA_dataID` int(11) DEFAULT '0' COMMENT '与其它表关联ID',
  `MA_userID` int(11) DEFAULT '0' COMMENT '与用户表关联ID',
  `MA_userName` varchar(50) DEFAULT '' COMMENT '留言用户名，管理列表显示',
  `MA_contact` text COMMENT '联系方式',
  `MA_userInfo` text COMMENT '用户其它相关信息',
  `MA_subIP` varchar(50) DEFAULT NULL COMMENT '信息提交IP',
  `MA_otherInfo` text COMMENT '其它信息',
  `MA_note` text COMMENT '用户留言内容',
  `MA_reply` text COMMENT '管理员回复内容',
  `MA_status` smallint(1) DEFAULT '0' COMMENT '审核状态',
  `zt` int(8) NOT NULL DEFAULT '0',
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MA_ID`),
  KEY `MA_dataID` (`MA_dataID`),
  KEY `MA_ID` (`MA_ID`),
  KEY `MA_userID` (`MA_userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_tgbz`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_tgbz`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_tgbz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zffs1` int(8) NOT NULL DEFAULT '0',
  `zffs2` int(8) NOT NULL DEFAULT '0',
  `zffs3` int(8) NOT NULL DEFAULT '0',
  `jb` decimal(15,0) NOT NULL DEFAULT '0',
  `zt` int(8) NOT NULL DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `qr_zt` int(255) DEFAULT '0',
  `user_tjr` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_nc` varchar(255) DEFAULT NULL,
  `cf_ds` int(8) NOT NULL DEFAULT '0',
  `jycg_ds` int(8) NOT NULL DEFAULT '0',
  `yid` int(11) DEFAULT NULL,
  `ok` tinyint(1) NOT NULL DEFAULT '1',
  `pdend` int(10) DEFAULT '0',
  `pdday` int(10) DEFAULT NULL,
  `old_pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_tixian`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_tixian`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UG_account` varchar(60) DEFAULT NULL,
  `TX_money` decimal(15,0) DEFAULT '0',
  `status` int(6) DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  `zffs` int(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_topup`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_topup`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_topup` (
  `TU_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户订单表',
  `TU_type` varchar(30) DEFAULT '' COMMENT '订单类型',
  `TU_time` datetime DEFAULT NULL COMMENT '添加时间',
  `TU_revTime` datetime DEFAULT NULL COMMENT '状态修改时间',
  `TU_userID` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `TU_money` float(11,2) DEFAULT '0.00' COMMENT '充值金额',
  `TU_payment` varchar(30) DEFAULT '' COMMENT '充值方式',
  `TU_userNote` varchar(250) DEFAULT '' COMMENT '会员留言',
  `TU_adminNote` varchar(250) DEFAULT '' COMMENT '管理员备注',
  `TU_status` tinyint(1) DEFAULT '0' COMMENT '到款状态',
  PRIMARY KEY (`TU_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_upfile`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_upfile`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_upfile` (
  `UF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UF_time` datetime DEFAULT NULL,
  `UF_type` varchar(25) DEFAULT NULL,
  `UF_oldName` varchar(80) DEFAULT NULL,
  `UF_name` varchar(50) DEFAULT NULL,
  `UF_ext` varchar(10) DEFAULT NULL,
  `UF_size` int(11) DEFAULT '0',
  `UF_width` int(11) DEFAULT '0',
  `UF_height` int(11) DEFAULT '0',
  `UF_isThumb` smallint(6) DEFAULT '0',
  `UF_thumbName` varchar(50) DEFAULT NULL,
  `UF_useNum` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`UF_ID`),
  UNIQUE KEY `UF_ID` (`UF_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_user`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_user`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_user` (
  `UE_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商城用户注册登录表',
  `UE_img` varchar(60) DEFAULT '' COMMENT '用户头像',
  `UE_account` varchar(60) NOT NULL DEFAULT '' COMMENT '登录账号',
  `UE_accName` varchar(60) DEFAULT NULL COMMENT '推荐人账号',
  `sfjl` int(15) NOT NULL DEFAULT '0',
  `zcr` varchar(60) NOT NULL,
  `UE_Faccount` varchar(30) DEFAULT '0' COMMENT '父账号',
  `UE_verMail` varchar(60) NOT NULL DEFAULT '' COMMENT '验证邮箱',
  `UE_check` smallint(1) DEFAULT '0' COMMENT '是否验证，0-未验证，1-邮箱验证，2-手机验证',
  `UE_actiCode` varchar(10) DEFAULT '' COMMENT '邮箱/手机验证激活码',
  `UE_password` varchar(80) DEFAULT '' COMMENT '用户密码',
  `UE_question` varchar(250) DEFAULT '' COMMENT '密码问题',
  `UE_question2` varchar(255) DEFAULT NULL,
  `UE_question3` varchar(255) DEFAULT NULL,
  `UE_answer` varchar(100) DEFAULT '' COMMENT '密码答案',
  `UE_answer3` varchar(100) DEFAULT NULL,
  `UE_answer2` varchar(100) DEFAULT NULL,
  `UE_regTime` datetime DEFAULT NULL COMMENT '注册时间',
  `UE_regIP` varchar(60) DEFAULT '',
  `UE_nowTime` datetime DEFAULT NULL COMMENT '当前登录时间',
  `UE_nowIP` varchar(60) DEFAULT '' COMMENT '当前登录IP',
  `UE_lastTime` datetime DEFAULT NULL COMMENT '最近一次登录时间',
  `UE_lastIP` varchar(60) DEFAULT '' COMMENT '最近一次录陆IP',
  `UE_logNum` int(11) DEFAULT '0' COMMENT '用户登录次数',
  `UE_status` smallint(1) DEFAULT '1' COMMENT '用户状态，0-正常，1-禁用',
  `UE_level` smallint(1) DEFAULT '0' COMMENT '会员等级',
  `UE_note` text COMMENT '管理页备注信息',
  `UE_integral` decimal(15,0) DEFAULT '0' COMMENT '当前账户积分余额',
  `UE_money` decimal(15,0) DEFAULT '0' COMMENT '当前帐户余额',
  `UE_sum` float(11,0) DEFAULT '0' COMMENT '当前账户总消费数',
  `UE_info` text COMMENT '用户信息',
  `UE_secpwd` varchar(80) DEFAULT NULL COMMENT '二级密码',
  `UE_theme` varchar(60) DEFAULT '',
  `UE_tjx` varchar(60) DEFAULT NULL COMMENT '推荐想总和',
  `UE_ldx` varchar(60) DEFAULT NULL COMMENT '领导奖',
  `UE_mailCheck` varchar(30) DEFAULT '0' COMMENT '邮箱验证0未验证，1验证了',
  `UE_sfz` varchar(20) DEFAULT NULL COMMENT '生分证',
  `UE_qq` varchar(20) DEFAULT NULL,
  `UE_phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `UE_truename` varchar(60) DEFAULT NULL COMMENT '真实名字',
  `UE_activeTime` datetime DEFAULT NULL COMMENT '激活时间',
  `UE_stop` tinyint(2) DEFAULT '1' COMMENT '停止分红，0标志停止分红，1标志正常分红',
  `UE_toActive` tinyint(2) DEFAULT '0' COMMENT '1表示已经被用过去激活新增帐号',
  `UE_drpd` varchar(60) DEFAULT NULL,
  `zbqx` int(5) NOT NULL DEFAULT '0' COMMENT '是否充许其它账号转币',
  `zbzh` varchar(60) DEFAULT NULL,
  `ybhe` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `zsbhe` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `email` varchar(60) DEFAULT NULL,
  `jihuouser` varchar(60) NOT NULL,
  `btbdz` varchar(60) NOT NULL DEFAULT '0',
  `pin` varchar(255) DEFAULT NULL,
  `mz` varchar(255) DEFAULT NULL,
  `xin` varchar(255) DEFAULT NULL,
  `weixin` varchar(255) DEFAULT NULL,
  `lx_weixin` varchar(255) DEFAULT NULL,
  `zfb` varchar(255) DEFAULT NULL,
  `yhmc` varchar(255) DEFAULT NULL,
  `zhxm` varchar(255) DEFAULT NULL,
  `yhzh` varchar(255) DEFAULT NULL,
  `tz_leiji` decimal(15,0) NOT NULL DEFAULT '0',
  `date_leiji` datetime DEFAULT NULL,
  `jl_he` decimal(15,0) NOT NULL DEFAULT '0',
  `tj_he` decimal(15,0) NOT NULL DEFAULT '0',
  `jl_he1` decimal(15,0) NOT NULL DEFAULT '0',
  `tj_he1` decimal(15,0) NOT NULL DEFAULT '0',
  `pp_user` varchar(255) DEFAULT NULL,
  `tx_leiji` decimal(15,0) NOT NULL,
  `tx_date` datetime DEFAULT NULL,
  `tj_num` int(11) DEFAULT '0',
  `levelname` varchar(20) DEFAULT '0',
  `isNew` tinyint(1) DEFAULT '1',
  `tdnode` int(11) DEFAULT '0' COMMENT '团队奖节点',
  `dongjie` int(11) unsigned DEFAULT '0' COMMENT '冻结钱包',
  PRIMARY KEY (`UE_ID`),
  UNIQUE KEY `anme` (`UE_account`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_user` */
 INSERT INTO `rrhbt2t8888_user` VALUES ('32',null,'niuniu','admin@qq.com','0','admin@qq.com','0',null,'1',null,'5c67af1abce23ba41992576d94a3041b',null,null,null,null,null,null,'2016-05-30 18:41:37','59.51.60.10','2016-05-30 19:16:41',null,null,null,'0','0','1',null,'0','21000','0',null,'5c67af1abce23ba41992576d94a3041b','BC金融',null,null,'0',null,null,'13285087184','妞妞','2016-07-16 17:17:01','1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,'系统帐号（周恒）',null,'mofanwo@foxmail.com','系统帐号',null,'系统帐号','400','2016-07-16 17:38:03','0','0','0','0','ab123456','0',null,'5','B1','0','1','0'),('33',null,'778899','niuniu','0','niuniu','0',null,'1',null,'e10adc3949ba59abbe56e057f20f883e','q1',null,null,'不知道',null,null,'2016-05-30 19:02:16','59.51.60.10','2016-07-07 09:32:56',null,null,null,'0','0','1',null,'0','9000','0',null,'5c67af1abce23ba41992576d94a3041b','成成',null,null,'0',null,null,'13285087184','成成','2016-07-07 10:07:02','1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,null,null,null,null,null,null,'600','2016-07-16 17:44:38','0','0','0','0','ab123456','0',null,'0','B1','0','1','0'),('34',null,'ab123456','niuniu','0','niuniu','0',null,'1',null,'5c67af1abce23ba41992576d94a3041b','q2',null,null,'不知道',null,null,'2016-05-30 19:11:57','59.51.60.10','2016-05-30 20:12:48',null,null,null,'0','0','1',null,'0','0','0',null,'5c67af1abce23ba41992576d94a3041b','小白',null,null,'0',null,null,'17069882035','小白','2016-05-30 20:12:48','1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,null,null,null,null,null,null,'1000','2016-07-16 17:49:21','0','0','0','0','niuniu','0',null,'2','B1','0','0','0'),('35',null,'wanggang','niuniu','0','niuniu','0',null,'1',null,'e10adc3949ba59abbe56e057f20f883e','q1',null,null,'不知道',null,null,'2016-05-30 19:15:07','59.51.60.10','2016-05-30 19:15:32',null,null,null,'0','0','0',null,'0','0','0',null,'e10adc3949ba59abbe56e057f20f883e','成成大哥',null,null,'0',null,null,'15200555557','成成大哥',null,'1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,null,null,null,null,null,null,'50000','2016-05-30 19:15:39','0','0','0','0','niuniu','0',null,'0','B0','1','1','0'),('36',null,'ab12345','ab123456','0','ab123456','0',null,'1',null,'e10adc3949ba59abbe56e057f20f883e','q2',null,null,'不知道',null,null,'2016-05-30 19:16:16','59.51.60.10','2016-05-30 19:56:57',null,null,null,'0','0','1',null,'0','0','0',null,'e10adc3949ba59abbe56e057f20f883e','小胖',null,null,'0',null,null,'18684588806','小胖','2016-05-30 19:42:40','1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,null,null,null,null,null,null,'100000','2016-05-30 19:16:49','0','0','0','0','niuniu','0',null,'1','B1','0','0','0'),('37',null,'ab1234','ab12345','0','ab12345','0',null,'1',null,'9cbf8a4dcb8e30682b927f352d6559a0','q3',null,null,'不知道',null,null,'2016-05-30 19:33:22','59.51.60.10','2016-05-30 23:55:07',null,null,null,'0','0','1',null,'0','0','0',null,'9cbf8a4dcb8e30682b927f352d6559a0','小大大',null,null,'0',null,null,'17775619520','小大大','2016-07-16 10:49:32','1','0',null,'0',null,'0.0000','0.0000',null,null,'0',null,null,null,null,null,null,null,null,null,'50000','2016-05-30 19:33:47','0','0','0','0','niuniu','0',null,'0','B1','1','0','0');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_user_jj`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_user_jj`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_user_jj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `r_id` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `zt` int(8) NOT NULL DEFAULT '0',
  `jb` decimal(15,0) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_user_jj` */
 INSERT INTO `rrhbt2t8888_user_jj` VALUES ('1','778899','1','2016-07-16 17:44:38','提供帮助','0','780','1'),('2','niuniu','2','2016-07-16 17:38:03','提供帮助','0','520','1'),('3','ab123456','4','2016-07-16 17:49:52','提供帮助','0','520','1'),('4','ab123456','3','2016-07-16 17:49:21','提供帮助','0','780','0');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_user_jl`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_user_jl`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_user_jl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `r_id` int(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `zt` int(8) NOT NULL DEFAULT '1',
  `jb` decimal(15,0) DEFAULT NULL,
  `ds` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `jj` decimal(10,0) DEFAULT NULL,
  `leixin` int(8) NOT NULL DEFAULT '0',
  `from` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_user_jl` */
 INSERT INTO `rrhbt2t8888_user_jl` VALUES ('1','niuniu','0','2016-07-16 17:46:50','0','48','动态奖','1代动态奖8%','48','0','778899'),('2','niuniu','0','2016-07-16 17:52:43','0','32','动态奖','1代动态奖8%','32','0','ab123456'),('3','niuniu','0','2016-07-16 17:53:04','0','48','动态奖','1代动态奖8%','48','0','ab123456');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_useraddr`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_useraddr`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_useraddr` (
  `UA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户收货地址信息',
  `UA_userID` int(11) DEFAULT '0' COMMENT '用户表ID',
  `UA_time` datetime DEFAULT NULL COMMENT '添加时间',
  `UA_revTime` datetime DEFAULT NULL COMMENT '修改时间',
  `UA_name` varchar(30) DEFAULT '' COMMENT '收货人姓名',
  `UA_area` varchar(30) DEFAULT '' COMMENT '配送区域',
  `UA_address` text COMMENT '其它地址信息',
  `UA_contact` text COMMENT '联系方式信息',
  `UA_note` text COMMENT '备注信息',
  `UA_otherInfo` text COMMENT '其它相关信息',
  PRIMARY KEY (`UA_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_userget`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_userget`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_userget` (
  `UG_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '商城用户注册登录表',
  `UG_account` varchar(60) NOT NULL DEFAULT '' COMMENT '登录账号',
  `UG_type` varchar(60) DEFAULT '' COMMENT '奖金分类',
  `UG_integral` decimal(15,4) DEFAULT '0.0000' COMMENT '当前账户种子币余额',
  `UG_money` varchar(255) DEFAULT '0.0000' COMMENT '当前帐户金币余额',
  `UG_getTime` datetime DEFAULT NULL COMMENT '结算时间',
  `UG_allGet` decimal(20,0) DEFAULT NULL COMMENT '用户密码',
  `UG_balance` decimal(20,0) DEFAULT NULL COMMENT '当前账户余额',
  `UG_regIP` varchar(30) DEFAULT '',
  `UG_dataType` varchar(10) DEFAULT '' COMMENT '分红类型',
  `UG_note` text COMMENT '金币获取说明',
  `UG_othraccount` varchar(60) DEFAULT NULL COMMENT '推荐帐号/开单帐号',
  `jsbzID` int(11) NOT NULL COMMENT '接收帮助表ID',
  `yb` decimal(15,4) DEFAULT '0.0000',
  `ybhe` decimal(15,4) DEFAULT NULL,
  `zsb` decimal(15,4) DEFAULT NULL,
  `zsbhe` decimal(15,4) DEFAULT NULL,
  `yb1` decimal(15,4) DEFAULT NULL,
  `zsb1` decimal(15,4) DEFAULT NULL,
  `varid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否转出',
  PRIMARY KEY (`UG_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `rrhbt2t8888_userget` */
 INSERT INTO `rrhbt2t8888_userget` VALUES ('1','niuniu','jb','0.0000','-1000','2016-07-16 17:37:57','22000','21000',null,'jsbz','接受帮助扣款',null,'1','0.0000',null,null,null,null,null,'0','1'),('2','778899','jb','0.0000','10000','2016-07-16 17:44:12','0','10000',null,'xtzs','系统操作',null,'0','0.0000',null,null,null,null,null,'0','1'),('3','778899','jb','0.0000','-1000','2016-07-16 17:44:48','10000','9000',null,'jsbz','接受帮助扣款',null,'4','0.0000',null,null,null,null,null,'0','1');/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_usergroup`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_usergroup`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_usergroup` (
  `UG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UG_time` datetime DEFAULT NULL,
  `UG_name` varchar(50) DEFAULT NULL,
  `UG_rightStr` longtext,
  `UG_note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`UG_ID`),
  KEY `UG_ID` (`UG_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_userinfo`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_userinfo`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_userinfo` (
  `UI_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户详细信息表',
  `UI_userID` int(11) DEFAULT '0' COMMENT '用户表ID',
  `UI_time` datetime DEFAULT NULL COMMENT '添加时间',
  `UI_revTime` datetime DEFAULT NULL COMMENT '修改时间',
  `UI_realName` varchar(30) DEFAULT '' COMMENT '真实姓名',
  `UI_payaccount` varchar(30) DEFAULT NULL COMMENT '收款账号信息',
  `UI_payStyle` varchar(10) DEFAULT NULL COMMENT '收款方式',
  `UI_isindex` smallint(1) DEFAULT NULL COMMENT '是否设为默认',
  `UI_opendress` varchar(30) DEFAULT NULL COMMENT '开户行',
  PRIMARY KEY (`UI_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_userjyinfo`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_userjyinfo`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_userjyinfo` (
  `UJ_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户交易信息表',
  `UJ_usercount` varchar(30) DEFAULT '0' COMMENT '用户表帐号',
  `UJ_time` datetime DEFAULT NULL COMMENT '转出转入时间',
  `UJ_addaccount` varchar(30) DEFAULT NULL COMMENT '转入账户',
  `UJ_payaccount` varchar(30) DEFAULT NULL COMMENT '转出帐号信息',
  `UJ_JBcount` decimal(15,4) DEFAULT NULL COMMENT '转账金币数量',
  `UJ_note` text COMMENT '备注',
  `UJ_style` varchar(10) DEFAULT NULL COMMENT '交易类型/转入/转出/担保交易',
  `UJ_ip` varchar(30) DEFAULT '' COMMENT '真实姓名',
  `UJ_balance` decimal(15,4) DEFAULT NULL,
  `UJ_dataType` varchar(10) DEFAULT NULL COMMENT '交易类型',
  `UJ_mymsg` tinyint(2) DEFAULT NULL COMMENT '消息读取状态0是读取，1是读取',
  `UJ_sysReplay` text COMMENT '系统回复',
  `UJ_jbqgStage` tinyint(2) DEFAULT '0' COMMENT '金币抢购状态，0是还没买走，1是被买走，等待付款，2是已经付款，等待卖家确认，3是交易完成',
  `UJ_dbjbID` varchar(10) DEFAULT NULL COMMENT '抢购金币时会存取担保金币的ID',
  `UJ_dbjyStage` tinyint(2) DEFAULT '0' COMMENT '担保交易状态0等待买家结束，1等待买家付款，2等待买家确认付款，3等待卖家确认收款',
  `UJ_jbmcStage` tinyint(2) DEFAULT '0' COMMENT '金币卖出审核状态，0是还没通过。1是系统通过审核',
  `lxfs` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`UJ_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_userlevel`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_userlevel`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_userlevel` (
  `UL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员等级划分表',
  `UL_theme` varchar(200) DEFAULT '' COMMENT '等级名称',
  `UL_price` float(11,2) DEFAULT '0.00' COMMENT '消费金额',
  `UL_cheap` float(11,2) DEFAULT '10.00' COMMENT '折扣',
  `UL_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`UL_ID`),
  UNIQUE KEY `IM_ID` (`UL_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `rrhbt2t8888_zsbyg_dd`  */
 DROP TABLE IF EXISTS `rrhbt2t8888_zsbyg_dd`;/* MySQLReback Separation */ CREATE TABLE `rrhbt2t8888_zsbyg_dd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(14) DEFAULT NULL COMMENT '提供帮助ID',
  `gid` int(14) DEFAULT NULL COMMENT '接受帮助ID',
  `puser` varchar(255) DEFAULT NULL,
  `guser` varchar(255) DEFAULT NULL,
  `gmfs` varchar(255) DEFAULT NULL,
  `sj` varchar(255) DEFAULT NULL,
  `shr` varchar(255) DEFAULT NULL,
  `shdz` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `leixin` varchar(255) DEFAULT NULL,
  `cpmc` varchar(255) DEFAULT NULL,
  `sfzj` varchar(255) DEFAULT NULL,
  `sffh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */