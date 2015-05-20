<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
        exit('Access Denied');
}

$common_plugin_warehouse     = DB::table('common_plugin_warehouse');
$common_plugin_warehouse_company     = DB::table('common_plugin_warehouse_company');
$common_plugin_warehouse_image = DB::table('common_plugin_warehouse_image');

$sql = <<<EOF

DROP TABLE IF EXISTS `$common_plugin_warehouse``;
CREATE TABLE IF NOT EXISTS `$common_plugin_warehouse` (
  `warehouseid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyid` mediumint(8) unsigned NOT NULL COMMENT '企业ID',
  `companyname` varchar(30) NOT NULL COMMENT '企业名称',
  `name` varchar(50) NOT NULL COMMENT '仓库名称',
  `type` tinyint(3) unsigned NOT NULL COMMENT '仓库类型',
  `status` tinyint(3) unsigned NOT NULL COMMENT '仓库状态',
  `floor` tinyint(3) unsigned NOT NULL COMMENT '仓库地面',
  `business` varchar(20) NOT NULL COMMENT '经营业务',
  `area` int(10) unsigned NOT NULL COMMENT '仓库面积',
  `high` float NOT NULL COMMENT '仓库净高',
  `platform_high` float unsigned NOT NULL COMMENT '平台高度',
  `platform_width` float unsigned NOT NULL COMMENT '平台宽度',
  `canopy_width` float unsigned NOT NULL COMMENT '雨棚宽度',
  `address` varchar(50) NOT NULL COMMENT '仓库地址',
  `content` text NOT NULL COMMENT '仓库详细',
  `lng` char(20) NOT NULL COMMENT '经度',
  `lat` char(20) NOT NULL COMMENT '纬度',
  `updatetime` int(10) unsigned NOT NULL COMMENT '更新时间',
  `addtime` int(10) unsigned NOT NULL COMMENT '增加时间',
  PRIMARY KEY (`warehouseid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='仓库主表' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `$common_plugin_warehouse_company`;
CREATE TABLE IF NOT EXISTS `$common_plugin_warehouse_company` (
  `companyid` mediumint(8) unsigned NOT NULL,
  `companyname` varchar(30) NOT NULL COMMENT '企业名称',
  `linkman` varchar(30) NOT NULL COMMENT '联系人',
  `phone` varchar(50) NOT NULL COMMENT '电话',
  `fax` varchar(50) NOT NULL COMMENT '传真',
  `email` varchar(30) NOT NULL COMMENT 'email',
  `founded` date NOT NULL COMMENT '成立时间',
  `website` varchar(50) NOT NULL COMMENT '公司网址',
  `address` varchar(50) NOT NULL COMMENT '公司地址',
  `content` text NOT NULL COMMENT '公司详细',
  `updatetime` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `$common_plugin_warehouse_image`;
CREATE TABLE IF NOT EXISTS `$common_plugin_warehouse_image` (
  `imageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `warehouseid` int(10) unsigned NOT NULL COMMENT '仓库ID',
  `imageurl` char(50) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`imageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

INSERT INTO `$common_plugin_warehouse` (`warehouseid`, `companyid`, `companyname`, `name`, `type`, `status`, `floor`, `business`, `area`, `high`, `platform_high`, `platform_width`, `canopy_width`, `address`, `content`, `lng`, `lat`, `updatetime`, `addtime`) VALUES
(3, 1, '河南青峰网络', '郑州某仓库', 2, 2, 99, '2,4,5', 1000, 20, 1, 0.5, 1.5, '河南省新乡市高新技术产业园', '青峰网络科技有限公司成立于2002年，是河南最早以网络服务为主经营的高科技公司，专业从事网站制作、网络营销策划、软件开发等服务，总部位于豫北重镇新乡，是新乡、洛阳、安阳、焦作、浙江金华地区百度营销服务中心。\r\n   \r\n青峰网络科技有限公司旗下目前设有洛阳、安阳、焦作、浙江金华四家分公司以及青峰咨询和河南聚创信息等全资子公司，先后为新乡电视台、卫华集团有限公司、洛阳牡丹医院、安阳钢人物资有限公司、焦作龙昌机械制造有限公司等5000余家企、事业单位提供了优质的网络营销服务和管理咨询服务，在增进客户利益、振兴地方经济的同时，公司也取得了百余倍增长的不俗业绩。', '113.884019', '35.309291', 1390532429, 1390396557),
(4, 1, '河南青峰网络', '河南某仓库', 2, 2, 2, '2,4', 200, 10, 5, 0, 0, '', '物流是一个控制原材料、制成品、产成品和信息的系统，从供应开始经各种中间环节的转让及拥有而到达最终消费者手中的实物运动，以此实现组织的明确目标。现代物流是经济全球化的产物，也是推动经济全球化的重要服务业。近年来，世界现代物流业呈稳步增长态势，欧洲、美国、日本成为当前全球范围内的重要物流基地。', '113.984845', '35.301868', 1390532409, 1390403480),
(5, 1, '河南青峰网络', '北京某某大型仓库', 1, 3, 2, '1,3,4', 100000, 30, 1.5, 10, 10, '北京市某某大型科技园', '仓库的详细介绍，暂不提供！', '116.391154', '39.929785', 1390531982, 1390531816);

INSERT INTO `$common_plugin_warehouse_company` (`companyid`, `companyname`, `linkman`, `phone`, `fax`, `email`, `founded`, `website`, `address`, `content`, `updatetime`) VALUES
(1, '物流沙龙', '某老板', '188 8888 8888', '010 45678910', 'logclub@logclub.com', '2014-01-23', 'www.logclub.com', '北京', '物流沙龙！国内最大的物流社区！', 1390532572);
        
INSERT INTO `$common_plugin_warehouse_image` (`imageid`, `warehouseid`, `imageurl`) VALUES
(15, 3, '201401/22/211558p9qjjq9t4q2zrs9q.jpg'),
(14, 3, '201401/22/211557nif9jm8baub4zap9.jpg'),
(13, 3, '201401/22/211557b99szmmba0a60s6s.jpg'),
(16, 3, '201401/24/013503i0wxh44ftqmm3s7t.jpg'),
(17, 5, '201401/24/105016zbntzzurtbdcebfu.jpg'),
(18, 5, '201401/24/105017ky1h17h2f1nhcnnc.jpg'),
(20, 4, '201401/24/110009tosn7zckpu8180o0.jpg');

EOF;

//执行SQL语句
runquery($sql);

//设置安装成功。必须为TRUE 如果为FALSE 则显示安装错误。
$finish = TRUE;
?>