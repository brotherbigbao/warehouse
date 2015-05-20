<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
        exit('Access Denied');
}

$common_plugin_warehouse     = DB::table('common_plugin_warehouse');
$common_plugin_warehouse_company     = DB::table('common_plugin_warehouse_company');
$common_plugin_warehouse_image = DB::table('common_plugin_warehouse_image');

$sql = <<<EOF
DROP TABLE IF EXISTS `$common_plugin_warehouse`;
DROP TABLE IF EXISTS `$common_plugin_warehouse_company`;
DROP TABLE IF EXISTS `$common_plugin_warehouse_image`;
EOF;

runquery($sql);

$finish = TRUE;
?>