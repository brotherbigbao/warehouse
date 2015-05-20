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
  `companyid` mediumint(8) unsigned NOT NULL COMMENT '��ҵID',
  `companyname` varchar(30) NOT NULL COMMENT '��ҵ����',
  `name` varchar(50) NOT NULL COMMENT '�ֿ�����',
  `type` tinyint(3) unsigned NOT NULL COMMENT '�ֿ�����',
  `status` tinyint(3) unsigned NOT NULL COMMENT '�ֿ�״̬',
  `floor` tinyint(3) unsigned NOT NULL COMMENT '�ֿ����',
  `business` varchar(20) NOT NULL COMMENT '��Ӫҵ��',
  `area` int(10) unsigned NOT NULL COMMENT '�ֿ����',
  `high` float NOT NULL COMMENT '�ֿ⾻��',
  `platform_high` float unsigned NOT NULL COMMENT 'ƽ̨�߶�',
  `platform_width` float unsigned NOT NULL COMMENT 'ƽ̨���',
  `canopy_width` float unsigned NOT NULL COMMENT '������',
  `address` varchar(50) NOT NULL COMMENT '�ֿ��ַ',
  `content` text NOT NULL COMMENT '�ֿ���ϸ',
  `lng` char(20) NOT NULL COMMENT '����',
  `lat` char(20) NOT NULL COMMENT 'γ��',
  `updatetime` int(10) unsigned NOT NULL COMMENT '����ʱ��',
  `addtime` int(10) unsigned NOT NULL COMMENT '����ʱ��',
  PRIMARY KEY (`warehouseid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='�ֿ�����' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `$common_plugin_warehouse_company`;
CREATE TABLE IF NOT EXISTS `$common_plugin_warehouse_company` (
  `companyid` mediumint(8) unsigned NOT NULL,
  `companyname` varchar(30) NOT NULL COMMENT '��ҵ����',
  `linkman` varchar(30) NOT NULL COMMENT '��ϵ��',
  `phone` varchar(50) NOT NULL COMMENT '�绰',
  `fax` varchar(50) NOT NULL COMMENT '����',
  `email` varchar(30) NOT NULL COMMENT 'email',
  `founded` date NOT NULL COMMENT '����ʱ��',
  `website` varchar(50) NOT NULL COMMENT '��˾��ַ',
  `address` varchar(50) NOT NULL COMMENT '��˾��ַ',
  `content` text NOT NULL COMMENT '��˾��ϸ',
  `updatetime` int(10) unsigned NOT NULL COMMENT '����ʱ��',
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS `$common_plugin_warehouse_image`;
CREATE TABLE IF NOT EXISTS `$common_plugin_warehouse_image` (
  `imageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `warehouseid` int(10) unsigned NOT NULL COMMENT '�ֿ�ID',
  `imageurl` char(50) NOT NULL COMMENT 'ͼƬ��ַ',
  PRIMARY KEY (`imageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

INSERT INTO `$common_plugin_warehouse` (`warehouseid`, `companyid`, `companyname`, `name`, `type`, `status`, `floor`, `business`, `area`, `high`, `platform_high`, `platform_width`, `canopy_width`, `address`, `content`, `lng`, `lat`, `updatetime`, `addtime`) VALUES
(3, 1, '�����������', '֣��ĳ�ֿ�', 2, 2, 99, '2,4,5', 1000, 20, 1, 0.5, 1.5, '����ʡ�����и��¼�����ҵ԰', '�������Ƽ����޹�˾������2002�꣬�Ǻ����������������Ϊ����Ӫ�ĸ߿Ƽ���˾��רҵ������վ����������Ӫ���߻�����������ȷ����ܲ�λ��ԥ���������磬�����硢�������������������㽭�𻪵����ٶ�Ӫ���������ġ�\r\n   \r\n�������Ƽ����޹�˾����Ŀǰ�����������������������㽭���ļҷֹ�˾�Լ������ѯ�ͺ��Ͼ۴���Ϣ��ȫ���ӹ�˾���Ⱥ�Ϊ�������̨�������������޹�˾������ĵ��ҽԺ�����������������޹�˾������������е�������޹�˾��5000�������ҵ��λ�ṩ�����ʵ�����Ӫ������͹�����ѯ�����������ͻ����桢���˵ط����õ�ͬʱ����˾Ҳȡ���˰��౶�����Ĳ���ҵ����', '113.884019', '35.309291', 1390532429, 1390396557),
(4, 1, '�����������', '����ĳ�ֿ�', 2, 2, 2, '2,4', 200, 10, 5, 0, 0, '', '������һ������ԭ���ϡ��Ƴ�Ʒ������Ʒ����Ϣ��ϵͳ���ӹ�Ӧ��ʼ�������м价�ڵ�ת�ü�ӵ�ж������������������е�ʵ���˶����Դ�ʵ����֯����ȷĿ�ꡣ�ִ������Ǿ���ȫ�򻯵Ĳ��Ҳ���ƶ�����ȫ�򻯵���Ҫ����ҵ���������������ִ�����ҵ���Ȳ�����̬�ƣ�ŷ�ޡ��������ձ���Ϊ��ǰȫ��Χ�ڵ���Ҫ�������ء�', '113.984845', '35.301868', 1390532409, 1390403480),
(5, 1, '�����������', '����ĳĳ���Ͳֿ�', 1, 3, 2, '1,3,4', 100000, 30, 1.5, 10, 10, '������ĳĳ���ͿƼ�԰', '�ֿ����ϸ���ܣ��ݲ��ṩ��', '116.391154', '39.929785', 1390531982, 1390531816);

INSERT INTO `$common_plugin_warehouse_company` (`companyid`, `companyname`, `linkman`, `phone`, `fax`, `email`, `founded`, `website`, `address`, `content`, `updatetime`) VALUES
(1, '����ɳ��', 'ĳ�ϰ�', '188 8888 8888', '010 45678910', 'logclub@logclub.com', '2014-01-23', 'www.logclub.com', '����', '����ɳ����������������������', 1390532572);
        
INSERT INTO `$common_plugin_warehouse_image` (`imageid`, `warehouseid`, `imageurl`) VALUES
(15, 3, '201401/22/211558p9qjjq9t4q2zrs9q.jpg'),
(14, 3, '201401/22/211557nif9jm8baub4zap9.jpg'),
(13, 3, '201401/22/211557b99szmmba0a60s6s.jpg'),
(16, 3, '201401/24/013503i0wxh44ftqmm3s7t.jpg'),
(17, 5, '201401/24/105016zbntzzurtbdcebfu.jpg'),
(18, 5, '201401/24/105017ky1h17h2f1nhcnnc.jpg'),
(20, 4, '201401/24/110009tosn7zckpu8180o0.jpg');

EOF;

//ִ��SQL���
runquery($sql);

//���ð�װ�ɹ�������ΪTRUE ���ΪFALSE ����ʾ��װ����
$finish = TRUE;
?>